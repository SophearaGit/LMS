<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'icon' => '/default-images/heroFeatureIcons/banner_feature_icon_1.png',
            'title' => 'Learn From Experts',
            'description' => 'Gain insights from industry leaders and experienced instructors who bring real-world knowledge to your learning experience.',
        ]);

        Feature::create([
            'icon' => '/default-images/heroFeatureIcons/banner_feature_icon_2.png',
            'title' => 'Earn a Certificate',
            'description' => 'Complete courses and earn certificates that validate your skills and knowledge, enhancing your professional credentials.',
        ]);

        Feature::create([
            'icon' => '/default-images/heroFeatureIcons/banner_feature_icon_3.png',
            'title' => '5400+ Courses',
            'description' => 'Explore a vast library of over 5400 courses across various subjects, ensuring you find the right course to meet your learning goals.',
        ]);
    }
}
