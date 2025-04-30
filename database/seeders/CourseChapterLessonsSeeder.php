<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\CourseChapterLessons;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CourseChapterLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all course and chapter IDs
        $course_arr_ids = array_map('intval', Course::pluck('id')->toArray());
        $chapter_arr_ids = CourseChapter::pluck('id')->toArray();

        // Loop through each chapter ID
        foreach ($chapter_arr_ids as $chapter_id) {
            // Number of lessons to create for each chapter
            $numberOfLessons = 1; // Adjust as needed

            // Loop to create lessons
            for ($i = 1; $i <= $numberOfLessons; $i++) {
                $lesson = [
                    "title" => $faker->sentence(3), // Generate a random title
                    "slug" => $faker->slug(), // Generate a URL-friendly slug
                    "description" => $faker->paragraph(), // Generate a random description
                    "instructor_id" => 2, // Modify as needed
                    "course_id" => $course_arr_ids, // Randomly select a course ID
                    "chapter_id" => $chapter_id,
                    "file_path" => "http://edu-core.info/files/2/avatar-4.jpg", // Example static path
                    "storage" => "upload",
                    "duration" => $faker->numberBetween(300, 3600), // Duration in seconds
                    "file_type" => "video", // Modify as needed
                    "downloadable" => 1,
                    "order" => $i, // Incremental order
                    "is_preview" => 1,
                    "status" => 1,
                    "lesson_type" => "lesson",
                ];

                // Insert the lesson into the database
                CourseChapterLessons::create($lesson); // Make sure to use the correct model name
            }
        }
    }
}
