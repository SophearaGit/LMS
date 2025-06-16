<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 7; $i++) {
            Testimonial::create([
                'rating' => random_int(1, 5),
                'review' => $faker->sentence(10),
                'user_image' => '/default-images/testimonials/avatar-' . $i . '.jpg',
                'user_name' => $faker->name(),
                'user_title' => $faker->jobTitle(),
            ]);
        }
    }
}
