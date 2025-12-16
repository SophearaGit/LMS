<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;

/*
|--------------------------------------------------------------------------
| ABA PayWay API URL
|--------------------------------------------------------------------------
| API URL that is provided by PayWay must be required in your post form
|
*/

define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase');

/*
|--------------------------------------------------------------------------
| ABA PayWay API KEY
|--------------------------------------------------------------------------
| API KEY that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_KEY', '308f1c5f450ff6d971bf8a805b4d18a6ef142464');

/*
|--------------------------------------------------------------------------
| ABA PayWay Merchant ID
|--------------------------------------------------------------------------
| Merchant ID that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_MERCHANT_ID', 'ec000262');

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $full_name = explode(" ", $user->name);
        $first_name = trim($full_name[0]);
        $last_name = trim($full_name[1]);
        $req_time = time();
        $merchant_id = ABA_PAYWAY_MERCHANT_ID;
        $transaction_id = time(); // TODO: update this line must be uniq id of checkout id
        $amount = 1; // TODO: update this
        $email = $user->email;
        $currency = "USD";
        $payment_option = 'abapay';
        // $callback_url = base64_encode('http://localhost:8000'); // TODO: make an post endpoint update carts data
        // $continue_success_url = "http://http://127.0.0.1:8000";
        $view_type = 'checkout';
        $hash =  self::getHash($req_time . $merchant_id . $transaction_id . $amount . $first_name  . $last_name . $email . $payment_option . $currency);

        $data = [
            'pageTitle' => 'CAITD | Checkout',
            'aba_hash' => $hash,
            'aba_api_url' => ABA_PAYWAY_API_URL,
            'req_time' => $req_time,
            'merchant_id' => $merchant_id,
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'email' => $email,
            'currency' => $currency,
            'payment_option' => $payment_option,
            // 'callback_url' => $callback_url,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'view_type' => $view_type,
        ];

        return view('front.pages.checkout', $data);
    }

    /**
     * Returns the getHash
     * For PayWay security, you must follow the way of encryption for hash.
     *
     * @param string $transaction_id
     * @param string $amount
     *
     * @return string getHash
     */
    public static function getHash($str)
    {

        $hash = base64_encode(hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true));
        return $hash;
    }
}
