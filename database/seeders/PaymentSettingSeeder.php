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


            ['key' => 'aba_status', 'value' => 'active'],
            ['key' => 'aba_currency', 'value' => 'KHR'],
            ['key' => 'aba_rate', 'value' => '1'],
            ['key' => 'aba_merchant_id', 'value' => 'ec462957'],
            ['key' => 'aba_public_key', 'value' => 'f8ef4e3da01e86f4f190156d91f5948c98a175eb'],
            ['key' => 'aba_rsa_public_key', 'value' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCw75mAl0gbuUuf8va6kXfHjaa22VK/L6wKx+Urz/VIl2R+7rjJbPIWWKMLrOs4C8QcaSoHv0HTUpsalYdl7EWMV2UuGBQEP/JAN5dh+UPQ6MvAxEEgKMq5MS0Sawu9XtF+WGDsYvf24tsfbjLc2JWPmCn5M1N8d3bY+tR8JSFsxQIDAQAB'],
            ['key' => 'aba_rsa_secret_key', 'value' => 'MIICXQIBAAKBgQDmbRgx+9zvNUFGb+vwrBIJpOIzhYBIK8vqgnuBg9B2lcfYWTyR9WndcbrA9UU9NtUyKHA+QAiRz4i8CQPbTZzwVS3ijD65TRqevAESWHmeJn22ix4KlaeyolYZYD4A5iexW1xTWPsYeZK2jFk7o395OLYOXYrH7kaXhUhMkU+59wIDAQABAoGAVp/tqCDMunq1SuMZelVdxJVhWkgWZUtdshASmSpyLJp7Uiid/isZ/N9b+11Zhb0+4cfVBnnxHsu71iC3e/LOC87UCWq45TrPt+5paRihSFacF3FNJ8LHlnfUg3/avm9Ik4i9AHTcDiIbzKIyqfI4x7ETMt1KoWDMCiwqRycfyg0CQQD+Ox/eChf7e1MWMi5iyLhubKpP3W1L9g52OFbEk1xIbq/vCdsf4s8Jj4vfaiiqN3/39LVSYXk3MO5gVzPu7P37AkEA6AeQst4k2iP6AG6W9uhw4zLvtyOnrIwM7ToY6LtKg18wx8/Db/JzB5jncAP5M24eYVtr1dDURwxR4E0zcs1fNQJBAJuSQqX1N0fE58slWg1JFtM729yTe1aIc8EUKMSSCF6qnS6BsX2JpXgMR2On6sp+u+hX7r1CuJJ1dumtczI6BBECQAf9orUWQ2yjyotTQ62zKZgZe/nxp2eg1x0gYBU7xgAqOhLXi+KCFgYP9QB9kop74130+Qy/CWB9AyDXZ8svWXUCQQDGrkNgW1mSfkBpl+IjTifcijB2g4m3JPLdxbHEBBo2soJCKDKoQP5lCkkjkb65ioLDKMf7zVD4yCrka8OxV8Qp'],
        ];
        PaymentSetting::insert($settings);
    }
}

