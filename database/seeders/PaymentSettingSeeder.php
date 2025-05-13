<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'paypal_mode', 'value' => 'sandbox'],
            ['key' => 'paypal_currency', 'value' => 'USD'],
            ['key' => 'paypal_rate', 'value' => '1'],
            ['key' => 'paypal_live_client_id', 'value' => ''],
            ['key' => 'paypal_live_client_secret', 'value' => ''],
            ['key' => 'paypal_live_app_id', 'value' => 'App_Id'],
            ['key' => 'stripe_status', 'value' => 'active'],
            ['key' => 'stripe_currency', 'value' => 'USD'],
            ['key' => 'stripe_rate', 'value' => '1'],
            ['key' => 'stripe_publishable_key', 'value' => ''],
            ['key' => 'stripe_secret_key', 'value' => ''],
            ['key' => 'razorpay_status', 'value' => 'active'],
            ['key' => 'razorpay_currency', 'value' => 'INR'],
            ['key' => 'razorpay_rate', 'value' => '84'],
            ['key' => 'razorpay_key_id', 'value' => ''],
            ['key' => 'razorpay_key_secret', 'value' => ''],
        ];

        PaymentSetting::insert($settings);

    }
}

