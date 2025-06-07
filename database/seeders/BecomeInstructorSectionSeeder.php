<?php

namespace Database\Seeders;

use App\Models\BecomeInstructorSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BecomeInstructorSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BecomeInstructorSection::create([
            'icon' => 'fa-solid fa-book',
            'label' => 'Become An Instructor',
            'title' => 'Be a Member & Share Your Knowledge.',
            'description' => '
                <p data-start="175" data-end="611">Join thousands of expert instructors around the world who are transforming lives through education. Whether you&apos;re a seasoned professional or passionate educator, our platform gives you the tools and support to create engaging courses and reach a global audience. Teach what you love &mdash; from tech and business to design and personal development &mdash; and get rewarded for it.</p>
            ',
            'btn_txt' => 'Become An Instructor',
            'btn_txt_url' => 'http://caitd.edu/login',
            'btn_icon' => 'fa-solid fa-arrow-right',
            'img' => '/default-images/becomeInstructorSectionImages/become_instructor_img.png',
        ]);
    }
}
