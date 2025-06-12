<?php

namespace Database\Seeders;

use App\Models\FeaturedInstructorSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturedInstructorSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeaturedInstructorSection::create([
            'title' => 'Find Your Perfect Instructor Match From The Spotlighted Collection',
            'subtitle' => 'Meet our featured instructors who are experts in their fields. Learn from the best in the industry and enhance your skills with their guidance.',
            'button_text' => 'All Featured Courses',
            'button_url' => 'http://caitd.edu/',
            'instructor_id' => 2,
            'featured_courses' => '["2", "3", "6"]',
            'instructor_image' => '/default-images/featured-instructor-section/meMonday-removebg.png',
        ]);
    }
}
