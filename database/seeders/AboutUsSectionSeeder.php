<?php

namespace Database\Seeders;

use App\Models\AboutUsSection;
use Illuminate\Database\Seeder;

class AboutUsSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUsSection::insert([
            'image' => '/default-images/aboutUsImages/about_3_img_1.png',
            'rounded_text' => 'take the worldwide best online course',
            'lerner_count' => 10000,
            'lerner_count_text' => 'Enrolled Learners',
            'lerner_image' => '/default-images/aboutUsImages/banner_2_photo_list.png',
            'title' => 'Study & Develop Your Skills Regardless of Location.',
            'description' => '
                <p><strong>
                Unlock your potential with flexible, high-quality education designed for learners everywhere.
                </strong></p>
                <ul>
                    <li><span style="background-color: rgb(255, 255, 255);">Expert Trainers</span></li>
                    <li><span style="background-color: rgb(255, 255, 255);">Online Remote Learning</span></li>
                    <li><span style="background-color: rgb(255, 255, 255);">Lifetime Access</span></li>
                </ul>
            ',
            'button_text' => 'Start Free Trial',
            'button_url' => 'http://caitd.edu/',
            'video_url' => 'https://youtu.be/XXYlFuWEuKI?si=4BvrrIBbF_oGFtjA',
            'video_image' => '/default-images/aboutUsImages/about_3_img_2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
