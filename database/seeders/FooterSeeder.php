<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        Footer::create([
            'description' => 'C.A.I.T Digitalization Co., Ltd. delivers innovative digital solutions, custom software development, web and mobile applications, cloud services, and IT consulting to help businesses accelerate their digital transformation.',
            'copyright' => 'Copyright © 2026 C.A.I.T Digitalization Co., Ltd. All Rights Reserved.',
            'phone' => '+855 12 345 678',
            'address' => 'Phnom Penh, Cambodia',
            'email' => 'info@caitdigital.com',
        ]);
    }
}
