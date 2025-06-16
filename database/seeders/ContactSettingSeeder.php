<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactSetting::create([
            'image' => '/default-images/contact-setting/meMonday.jpg',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16794.60113543434!2d104.9082155871582!3d11.583244800000017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095132743cbbe7%3A0xeab32fde9ac4ecac!2sWinsou%20Mart%20CCV!5e1!3m2!1sen!2skh!4v1749982707298!5m2!1sen!2skh',
        ]);
    }
}
