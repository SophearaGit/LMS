<?php

namespace Database\Seeders;

use App\Models\VideoSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoSection::create([
            'background_image' => '/default-images/video-section-images/video_bg.jpg',
            'video_url' => 'https://www.youtube.com/watch?v=ODT_01t4WyI',
            'description' => '
                <p>Explore a wide range of free online courses available in various subjects, allowing you to learn at your own pace from anywhere in the world.</p>
            ',
            'button_text' => 'Free Online Courses',
            'button_url' => 'http://caitd.edu/',
        ]);
    }
}
