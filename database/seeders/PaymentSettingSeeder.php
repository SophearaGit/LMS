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
            ['key' => 'paypal_live_client_id', 'value' => 'ARr7j0OIN6JxICl7dEYX3lxkfJO9uWQsEPYjg7seQANgFlFZqtqXs41O-1A5jpxRFfC_d4J5B8VFsKKI'],
            ['key' => 'paypal_live_client_secret', 'value' => 'EJrnKxwzWfLRQPa48QYA7Xh3StdnW9hlaMkuGyeyfiq_P49daeu4OxqjXnmhdrFcAF8EmdIJlFSieq_n'],
            ['key' => 'paypal_live_app_id', 'value' => 'App_Id'],
            ['key' => 'stripe_status', 'value' => 'active'],
            ['key' => 'stripe_currency', 'value' => 'USD'],
            ['key' => 'stripe_rate', 'value' => '1'],
            ['key' => 'stripe_publishable_key', 'value' => 'pk_test_51RNaIgB1B35b6k6WBDleaaRxVuxjQWNvPvV6Q3ynEsawd1JDIMhQztEkufETUIJRybp4etsF4ZO0YvxOiw8Jjgj700JUybEcK6'],
            ['key' => 'stripe_secret_key', 'value' => 'sk_test_51RNaIgB1B35b6k6W5Mz9vpaGjGgE1jf6aQeVzG3ddQOdliAczEDakpdqx7KM5lI3ehmCfa0o9OlGCiiHnqE8xeMC00aDvY7JrI'],
            ['key' => 'razorpay_status', 'value' => 'active'],
            ['key' => 'razorpay_currency', 'value' => 'INR'],
            ['key' => 'razorpay_rate', 'value' => '84'],
            ['key' => 'razorpay_key_id', 'value' => 'rzp_test_cvrsy43xvBZfDT'],
            ['key' => 'razorpay_key_secret', 'value' => 'c9AmI4C5vOfSWmZehhlns5df'],
        ];

        PaymentSetting::insert($settings);

    }
}
