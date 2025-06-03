<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::updateOrCreate(
            ['id' => 1],
            [
                'label' => 'Show Up For Learning Course',
                'title' => 'Premier E-Learning Courses From CAIDT',
                'subtitle' => 'Bridging the Gap Between Academic Knowledge and Real-World Application with Trusted, Interactive E-Learning Solutions from CAIDT',
                'btn_txt' => 'Start Free Trial',
                'btn_url' => 'https://www.youtube.com/watch?v=P-vQWxKYxaE',
                'vid_btn_txt' => 'See Our Lesson Showcase',
                'vid_btn_url' => 'https://www.youtube.com/watch?v=D_uLM5i0Z4c&t=11s&pp=0gcJCbAJAYcqIYzv',
                'banner_item_title' => '250+ Popular Course',
                'banner_item_subtitle' => 'Explore a variety of fresh topics',
                'image' => '/default-images/hero-images/toonSitReadGuy.png',
                'round_txt' => '.take .the .worldwide .best .online course',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
