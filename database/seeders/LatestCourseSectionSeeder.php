<?php

namespace Database\Seeders;

use App\Models\LatestCourseSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LatestCourseSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LatestCourseSection::updateOrCreate(
            ['id' => 1],
            [
                'category_one' => 20,
                'category_two' => 21,
                'category_three' => 22,
                'category_four' => 23,
                'category_five' => 24,
            ]
        );
    }
}
