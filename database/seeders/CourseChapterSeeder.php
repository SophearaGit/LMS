<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseChapter; // Ensure the correct model is imported
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; // Import Faker

class CourseChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all course IDs
        $course_arr_ids = array_map('intval', Course::pluck('id')->toArray());

        // Loop through each course ID
        foreach ($course_arr_ids as $course_id) {
            // Number of chapters to create for each course
            $numberOfChapters = 8; // Adjust as needed

            // Loop to create chapters
            for ($i = 1; $i <= $numberOfChapters; $i++) {
                $chapter = [
                    "title" => $i . '. ' . $faker->sentence(3), // Generate a random title
                    "instructor_id" => 2, // Modify as needed
                    "course_id" => $course_id,
                    "order" => $i, // Set order to the current index
                    "status" => 1,
                ];

                // Insert the chapter into the database
                CourseChapter::create($chapter);
            }
        }
    }
}
