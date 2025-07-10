<?php

namespace Database\Seeders;

use App\Models\TopBar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TopBar::create([
            'email' => 'caitofficial@gmail.com',
            'phone' => '+855 097 888 7777',
            'offer_name' => 'Khmer New Year Offer',
            'offer_description' => 'Get 20% off on all courses this khmer new year!',
            'offer_button_link' => 'https://youtu.be/XXYlFuWEuKI?si=uaA6JsT7zqvfPkk-',
            'offer_button_text' => 'Grab Offer',
        ]);
    }
}
