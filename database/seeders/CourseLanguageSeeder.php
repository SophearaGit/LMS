<?php

namespace Database\Seeders;

use App\Models\CourseLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'Khmer',
            'English',
            'Spanish',
            'French',
            'German',
            'Chinese',
            'Japanese',
            'Russian',
            'Italian',
            'Portuguese',
            'Arabic',
            'Korean',
            'Hindi',
            'Bengali',
            'Turkish',
            'Vietnamese',
            'Thai',
            'Indonesian',
            'Malay',
            'Filipino',
            'Swahili',
            'Dutch',
            'Polish',
        ];

        foreach ($languages as $language) {
            CourseLanguage::create([
                'name' => $language,
                'slug' => Str::slug($language),
            ]);
        }
    }
}
