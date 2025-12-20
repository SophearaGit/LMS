<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $data = [
            'PageTitle' => 'CAITD | Payment Settings',
        ];
        return view('admin.pages.payment-settings.index', $data);
    }

    public function paypal_store(Request $request)
    {
        $validated_data = $request->validate([
            'paypal_mode' => 'required|string|in:sandbox,live',
            'paypal_currency' => 'required|string|max:3',
            'paypal_rate' => 'required|numeric',
            'paypal_live_client_id' => 'required|string',
            'paypal_live_client_secret' => 'required|string',
            'paypal_live_app_id' => 'required|string',
        ]);

        foreach ($validated_data as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('gatewaySettings');

        notyf()->success('Payment settings updated successfully.');

        return redirect()->back();
    }

    public function stripe_store(Request $request)
    {
        $validated_data = $request->validate([
            'stripe_status' => 'required|string|in:active,inactive',
            'stripe_currency' => 'required|string|max:3',
            'stripe_rate' => 'required|string',
            'stripe_publishable_key' => 'required|string',
            'stripe_secret_key' => 'required|string',
        ]);

        foreach ($validated_data as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('gatewaySettings');

        notyf()->success('Stripe settings updated successfully.');

        return redirect()->back();
    }

    public function razorpay_store(Request $request)
    {
        $validated_data = $request->validate([
            'razorpay_status' => 'required|string|in:active,inactive',
            'razorpay_currency' => 'required|string|max:3',
            'razorpay_rate' => 'required|string',
            'razorpay_key_id' => 'required|string',
            'razorpay_key_secret' => 'required|string',
        ]);

        foreach ($validated_data as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('gatewaySettings');

        notyf()->success('Razorpay settings updated successfully.');

        return redirect()->back();
    }

    // aba_store
    public function aba_store(Request $request)
    {
        $validated_data = $request->validate([
            'aba_status' => 'required|string|in:active,inactive',
            'aba_currency' => 'required|string|max:3',
            'aba_rate' => 'required|string',
            'aba_merchant_id' => 'required|string',
            'aba_public_key' => 'required|string',
            'aba_rsa_public_key' => 'required|string',
            'aba_rsa_secret_key' => 'required|string',
        ]);

        foreach ($validated_data as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('gatewaySettings');

        notyf()->success('ABA settings updated successfully.');

        return redirect()->back();
    }

}
