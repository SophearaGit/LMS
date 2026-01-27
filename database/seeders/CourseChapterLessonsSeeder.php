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

        $course_arr_ids = array_map('intval', Course::pluck('id')->toArray());

        foreach ($course_arr_ids as $course_id) {
            $chapters = CourseChapter::where('course_id', $course_id)->pluck('id')->toArray();

            foreach ($chapters as $chapter_id) {
                $numberOfLessons = 3;

                for ($i = 1; $i <= $numberOfLessons; $i++) {
                    $lesson = [
                        "title" => $i . '. ' . $faker->sentence(3), // Generate a random title
                        "slug" => $i . '. ' . $faker->slug(3),
                        "description" => $faker->text(150),
                        "instructor_id" => 2, // Modify as needed
                        "chapter_id" => $chapter_id,
                        "course_id" => $course_id,
                        // "file_path => "https://youtu.be/UjBhbMMgLzc?si=ZbKmtzkJiKexqzqW",
                        "file_path" => "https://youtu.be/I5kj-YsmWjM?si=XLcOB806tJKbhWvE",
                        "storage" => "youtube",
                        "duration" => $faker->numberBetween(30, 600),
                        "file_type" => "video",
                        "order" => $i, // Set order to the current index
                        "is_preview" => 1,
                        "status" => 1,
                        "lesson_type" => "lesson",
                    ];

                    // Insert the lesson into the database
                    CourseChapterLessons::create($lesson);
                }
            }
        }



    }
}
