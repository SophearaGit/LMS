<?php

namespace Database\Seeders;

use App\Models\FooterColumnOne;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterColumnOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterColumnOne::insert([
            [
                'title' => 'Home',
                'url' => '/',
                'status' => 1,
            ],
            [
                'title' => 'About Us',
                'url' => '/about-us',
                'status' => 1,
            ],
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
        ]);
    }
}
