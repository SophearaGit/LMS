<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Razorpay\Api\Api as RazorpayApi;

class PaymentController extends Controller
{
    public function orderSuccess()
    {
        notyf()->success('Your order has been placed successfully.');
        return view('front.pages.order-success', );
    }

    public function orderFail()
    {
        notyf()->error('Your order has failed. Please try again.');
        return view('front.pages.order-fail');
    }

    public function paypalConfig(): array
    {
        return [
            'mode' => config('gateway_setting.paypal_mode'),
            'sandbox' => [
                'client_id' => config('gateway_setting.paypal_live_client_id'),
                'client_secret' => config('gateway_setting.paypal_live_client_secret'),
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => config('gateway_setting.paypal_live_client_id'),
                'client_secret' => config('gateway_setting.paypal_live_client_secret'),
                'app_id' => config('gateway_setting.paypal_live_app_id'),
            ],
            'payment_action' => "Sale",
            'currency' => config('gateway_setting.paypal_currency'),
            'notify_url' => '',
            'locale' => "en_US",
            'validate_ssl' => true,
        ];
    }

    public function payWithPaypal()
    {
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();

        $payableAmount = cartTotalPrice() * config('gateway_setting.paypal_rate');

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
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $captures = $response['purchase_units'][0]['payments']['captures'][0];
            $transaction_id = $captures['id'];
            $main_amount = cartTotalPrice();
            $amount = $captures['amount']['value'];
            $currency = $captures['amount']['currency_code'];

            try {
                OrderService::storeOrder(
                    $transaction_id,
                    Auth::user()->id,
                    'approved',
                    $main_amount,
                    $amount,
                    $currency,
                    'paypal'
                );

                return redirect()->route('order.success');
            } catch (\Throwable $e) {
                throw $e;
            }
        }

        return redirect()->route('order.fail')->with('error', 'Payment failed');
    }

    public function payWithStripe()
    {
        Stripe::setApiKey(config('gateway_setting.stripe_secret_key'));

        $payable_amount = intval(cartTotalPrice() * 100 * config('gateway_setting.stripe_rate'));
        $gty_count = cartTotalCourseCount();

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('gateway_setting.stripe_currency'),
                        'product_data' => [
                            'name' => 'Course',
                        ],
                        'unit_amount' => $payable_amount,
                    ],
                    'quantity' => $gty_count,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($response->url);
    }

    public function stripeSuccess(Request $request)
    {
        Stripe::setApiKey(config('gateway_setting.stripe_secret_key'));

        $response = StripeSession::retrieve($request->session_id);
        if ($response->payment_status == 'paid') {
            $transaction_id = $response->payment_intent;
            $amount = $response->amount_total / 100;
            $currency = $response->currency;

            try {
                OrderService::storeOrder(
                    $transaction_id,
                    Auth::user()->id,
                    'approved',
                    $amount,
                    $amount,
                    $currency,
                    'stripe'
                );

                return redirect()->route('order.success')->with('success', 'Payment successful');
            } catch (\Throwable $e) {
                throw $e;
            }
        } else {
            return redirect()->route('order.fail')->with('error', 'Payment failed');
        }
    }

    public function stripeCancel(Request $request)
    {
        dd($request->all());
    }

    public function razorpayRedirect()
    {
        return view('front.pages.razorpay-redirect');
    }

    public function payWithRazorpay(Request $request)
    {
        $api = new RazorpayApi(
            config('gateway_setting.razorpay_key_id'),
            config('gateway_setting.razorpay_key_secret'),
        );

        $payable_amount = cartTotalPrice() * 100 * config('gateway_setting.razorpay_rate');

        try {
            $res = $api->payment->fetch($request->razorpay_payment_id)->capture(['amount' => $payable_amount]);
            if ($res->status == 'captured') {
                OrderService::storeOrder(
                    $res->id,
                    Auth::user()->id,
                    'approved',
                    cartTotalPrice(),
                    $res->amount / 100,
                    $res->currency,
                    'razorpay'
                );
                return redirect()->route('order.success')->with('success', 'Payment successful');
            }
            return redirect()->route('order.fail')->with('error', 'Payment failed');
        } catch (\Throwable $e) {
            $error = $e->getMessage();
            dd($error);
        }
    }
}
