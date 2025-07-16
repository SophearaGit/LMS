<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::insert([
            [
                'name' => 'Business',
                'slug' => 'business',
                'status' => 1,
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'status' => 1,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'status' => 1,
            ],
            [
                'name' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'status' => 1,
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'status' => 1,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'status' => 1,
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'status' => 1,
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'status' => 1,
            ],
            [
                'name' => 'Art',
                'slug' => 'art',
                'status' => 1,
            ],
        ]);
    }
}
