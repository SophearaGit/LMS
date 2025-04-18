<?php

namespace Database\Seeders;

use App\Models\CourseLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            'Beginner',
            'Intermediate',
            'Advanced',
            'Expert',
            'Novice',
            'Proficient',
            'Master',
        ];

        foreach ($levels as $level) {
            CourseLevel::create([
                'name' => $level,
                'slug' => Str::slug($level),
            ]);
        }
    }
}
