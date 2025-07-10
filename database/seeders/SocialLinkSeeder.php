<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialLink::insert(
            [
                [
                    'icon' => '/default-images/social-link/x.png',
                    'link' => 'https://youtu.be/9kzE8isXlQY?si=xTqid_-qyzzvhNZy',
                    'status' => 1,
                ],
                [
                    'icon' => '/default-images/social-link/facebook.png',
                    'link' => 'https://youtu.be/9kzE8isXlQY?si=xTqid_-qyzzvhNZy',
                    'status' => 1,
                ],
                [
                    'icon' => '/default-images/social-link/linkedin.png',
                    'link' => 'https://youtu.be/9kzE8isXlQY?si=xTqid_-qyzzvhNZy',
                    'status' => 1,
                ],
            ]
        );

    }
}
