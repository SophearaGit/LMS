<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course_file_path = public_path('default-images/course');
        $path_to_upload_course = public_path('uploads/');

        $course_imgs = File::files($course_file_path);

        if (count($course_imgs) === 0) {
            return;
        }

        if (!File::exists($path_to_upload_course)) {
            File::makeDirectory($path_to_upload_course, 0777, recursive: true, force: true);
        }

        $faker = Faker::create();

        // Get the IDs
        $category_arr_ids = array_map('intval', CourseCategory::whereNotNull('parent_id')->pluck('id')->toArray());
        $level_arr_ids = array_map('intval', CourseLevel::pluck('id')->toArray());
        $language_arr_ids = array_map('intval', CourseLanguage::pluck('id')->toArray());

        // Shuffle images
        $course_imgs = collect($course_imgs)->shuffle();

        // Track image index
        $imgIndex = 0;

        foreach ($category_arr_ids as $category_id) {
            for ($i = 0; $i < 4; $i++) {
                // If we've run out of images, reshuffle or use default
                if (!isset($course_imgs[$imgIndex])) {
                    $course_imgs = collect(File::files($course_file_path))->shuffle();
                    $imgIndex = 0;
                }

                $img = $course_imgs[$imgIndex++];
                $filename = '/educore_' . Str::random(10) . '.' . $img->getExtension();
                $destinationPath = $path_to_upload_course . '/' . $filename;

                File::copy($img->getPathname(), $destinationPath);

                $title = $faker->sentence(3);

                Course::create([
                    "instructor_id" => 2,
                    "category_id" => $category_id,
                    "course_type" => "course",
                    "title" => $title,
                    "slug" => Str::slug($title) . '-' . Str::random(5),
                    "seo_description" => $faker->text(150),
                    "duration" => $faker->numberBetween(30, 600),
                    "thumbnail" => '/uploads' . $filename,
                    "demo_video_storage" => "youtube",
                    "demo_video_source" => "https://www.youtube.com/live/_2El-J5lxs4?si=lVAiOm0icJ_cdypT",
                    "description" => $faker->paragraph(5),
                    "capacity" => $faker->numberBetween(10, 100),
                    "price" => $faker->randomFloat(2, 50, 300),
                    "discount" => $faker->numberBetween(10, 90),
                    "certificate" => 1,
                    "qna" => 1,
                    "is_approved" => "approved",
                    "status" => "active",
                    "course_level_id" => $faker->randomElement($level_arr_ids),
                    "course_language_id" => $faker->randomElement($language_arr_ids),
                ]);
            }
        }
    }

}
