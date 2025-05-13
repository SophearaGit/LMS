<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CourseLanguageSeeder::class,
            CourseLevelSeeder::class,
            CourseCategorySeeder::class,
            CourseSeeder::class,
            CourseChapterSeeder::class,
            CourseChapterLessonsSeeder::class,
        ]);
    }
}
