<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{

    public function orderSuccess()
    {
        return view('front.pages.order-success');
    }

    public function orderFail()
    {
        return view('front.pages.order-fail');
    }


    public function payWithPaypal()
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();

        $payableAmount = cartTotalPrice();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $payableAmount,
                    ],
                ],
            ],
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $captures = $response['purchase_units'][0]['payments']['captures'][0];
            $transaction_id = $captures['id'];
            $amount = $captures['amount']['value'];
            $currency = $captures['amount']['currency_code'];
            try {
                OrderService::storeOrder(
                    $transaction_id,
                    Auth::user()->id,
                    'approved',
                    $amount,
                    $amount,
                    $currency,
                    'paypal'
                );
                return redirect()->route('order.success')->with('success', 'Payment successful');
            } catch (\Throwable $e)
            {
                throw $e;
            }
        }
        return redirect()->route('order.fail')->with('error', 'Payment failed');
    }

}
