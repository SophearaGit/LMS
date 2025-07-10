<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        Footer::create([
            'description' => 'Nunc in sollicitudin diam, ut bibendum malesuada sodales porttitor.',
            'copyright' => 'Copyright © 2024 All Rights Reserved by CAITD Education',
            'phone' => '+855 097 888 7777',
            'address' => '25-02 44th Queens, NY 3645, United States',
            'email' => 'your.email+fakedata71544@gmail.com',
        ]);
    }
}
