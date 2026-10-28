<?php

namespace Database\Seeders;

use App\Models\PayoutGateway;
use Illuminate\Database\Seeder;

/**
 * Payout gateways = the ways the platform PAYS instructors.
 *
 * Each description is shown to instructors as the placeholder of the
 * "Information" box on Instructor → Withdraw → Request payout, so it lists
 * exactly what the admin needs to send money TO that instructor
 * (never merchant API keys — those belong in Admin → Payment Settings).
 *
 * Instructors store their choice by gateway NAME, so keep names stable.
 * Safe to run more than once: rows are matched by name and updated.
 */
class PayoutGatewaySeeder extends Seeder
{
    public function run(): void
    {
        $gateways = [
            [
                'name' => 'Aba',
                'status' => 1,
                'description' => implode("\n", [
                    'Account holder name: (as shown in your ABA app, e.g. SOK DARA)',
                    'ABA account number: (9 digits, e.g. 000 123 456)',
                    'Account currency: USD or KHR',
                    'Phone number linked to ABA: (optional, e.g. 012 345 678)',
                ]),
            ],
            [
                'name' => 'Paypal',
                'status' => 1,
                'description' => implode("\n", [
                    'PayPal email: (the email your PayPal account receives money on)',
                    'Account holder name: (as shown on your PayPal account)',
                    'Country of your PayPal account: (e.g. Cambodia)',
                    'Preferred currency: USD',
                ]),
            ],
            [
                // Paying out through Stripe needs a Stripe Connect account on the instructor's side.
                'name' => 'Stripe',
                'status' => 0,
                'description' => implode("\n", [
                    'Stripe connected account ID: (starts with acct_, e.g. acct_1A2B3C4D5E)',
                    'Email on your Stripe account:',
                    'Account holder name:',
                    'Payout currency: (e.g. USD)',
                ]),
            ],
            [
                // RazorpayX payouts go to an Indian bank account or a UPI ID.
                'name' => 'Razorpay',
                'status' => 0,
                'description' => implode("\n", [
                    'Account holder name: (as on your bank account)',
                    'Bank account number:',
                    'IFSC code: (11 characters, e.g. HDFC0001234)',
                    'Or UPI ID instead of bank details: (e.g. name@okhdfcbank)',
                    'Phone number: (linked to the account)',
                ]),
            ],
        ];

        // The model has no $fillable, so allow mass assignment just for seeding.
        PayoutGateway::unguarded(function () use ($gateways) {
            foreach ($gateways as $gateway) {
                PayoutGateway::updateOrCreate(
                    ['name' => $gateway['name']],
                    ['description' => $gateway['description'], 'status' => $gateway['status']],
                );
            }
        });
    }
}
