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
        ];
        Setting::insert($settings );
    }
}
