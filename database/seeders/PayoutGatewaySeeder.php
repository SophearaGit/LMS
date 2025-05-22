<?php

namespace Database\Seeders;

use App\Models\PayoutGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayoutGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayoutGateway::insert([
            [
                'name' => 'Stripe',
                'description' => 'Publishable Key:"Enter your Stripe Publishable Key"',
                'status' => 1,
            ],
            [
                'name' => 'Razorpay',
                'description' => 'Key ID:"Enter your Razorpay Key ID"',
                'status' => 1,
            ],
            [
                'name' => 'Paypal',
                'description' => 'Client ID:"Enter your PayPal Client ID"',
                'status' => 1,
            ],
        ]);
    }
}
