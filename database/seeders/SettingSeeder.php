<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'commission', 'value' => '90'],
            ['key' => 'site_name', 'value' => 'CAIDT'],
            ['key' => 'site_phone', 'value' => '+855 070 7777 8888'],
            ['key' => 'site_address', 'value' => 'Phnom Penh, Cambodia'],
            ['key' => 'site_currency', 'value' => 'USD'],
            ['key' => 'site_currency_icon', 'value' => '$'],
            ['key' => 'sender_email', 'value' => 'miek@gmail.com'],
            ['key' => 'receiver_email', 'value' => 'seth@gmail.com'],
            ['key' => 'mail_mailer', 'value' => 'smtp'],
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['key' => 'mail_port', 'value' => '2525'],
            ['key' => 'mail_username', 'value' => '4196afde51c60b'],
            ['key' => 'mail_password', 'value' => '1d723a9e09694e'],
            ['key' => 'mail_queue', 'value' => 'true'],
            ['key' => 'mail_encryption', 'value' => 'tls'],
        ];
        Setting::insert($settings);
    }
}
