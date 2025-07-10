<?php

namespace Database\Seeders;

use App\Models\FooterColumnTwo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterColumnTwoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterColumnTwo::insert([
            [
                'title' => 'Courses',
                'url' => '/courses',
                'status' => 1,
            ],
            [
                'title' => 'Contact Us',
                'url' => '/contact-us',
                'status' => 1,
            ],
            [
                'title' => 'About Us',
                'url' => '/about-us',
                'status' => 1,
            ],
            [
                'title' => 'Home',
                'url' => '/',
                'status' => 1,
            ],
        ]);
    }
}
