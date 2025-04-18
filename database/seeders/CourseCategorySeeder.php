<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course_categories = [
            [
                'name' => 'Web Development',
                'icon' => 'ti ti-user',
                'slug' => Str::slug('Web Development'),
            ],
            [
                'name' => 'Mobile Development',
                'icon' => 'ti ti-mobile',
                'slug' => Str::slug('Mobile Development'),
            ],
            [
                'name' => 'Data Science',
                'icon' => 'ti ti-chart-pie',
                'slug' => Str::slug('Data Science'),
            ],
            [
                'name' => 'Machine Learning',
                'icon' => 'ti ti-brain',
                'slug' => Str::slug('Machine Learning'),
            ],
            [
                'name' => 'Cloud Computing',
                'icon' => 'ti ti-cloud',
                'slug' => Str::slug('Cloud Computing'),
            ],
            [
                'name' => 'Cyber Security',
                'icon' => 'ti ti-shield-check',
                'slug' => Str::slug('Cyber Security'),
            ],
            [
                'name' => 'Digital Marketing',
                'icon' => 'ti ti-chart-bar',
                'slug' => Str::slug('Digital Marketing'),
            ],
            [
                'name' => 'Graphic Design',
                'icon' => 'ti ti-palette',
                'slug' => Str::slug('Graphic Design'),
            ],
            [
                'name' => 'UI/UX Design',
                'icon' => 'ti ti-layout-grid',
                'slug' => Str::slug('UI/UX Design'),
            ],
            [
                'name' => 'Game Development',
                'icon' => 'ti ti-gamepad',
                'slug' => Str::slug('Game Development'),
            ],
            [
                'name' => 'Blockchain',
                'icon' => 'ti ti-lock',
                'slug' => Str::slug('Blockchain'),
            ],
            [
                'name' => 'DevOps',
                'icon' => 'ti ti-server',
                'slug' => Str::slug('DevOps'),
            ],
            [
                'name' => 'Software Testing',
                'icon' => 'ti ti-checkup-list',
                'slug' => Str::slug('Software Testing'),
            ],
            [
                'name' => 'Project Management',
                'icon' => 'ti ti-clipboard-list',
                'slug' => Str::slug('Project Management'),
            ],
            [
                'name' => 'Business Analysis',
                'icon' => 'ti ti-briefcase',
                'slug' => Str::slug('Business Analysis'),
            ],
            [
                'name' => 'Artificial Intelligence',
                'icon' => 'ti ti-robot',
                'slug' => Str::slug('Artificial Intelligence'),
            ],
            [
                'name' => 'Internet of Things',
                'icon' => 'ti ti-network',
                'slug' => Str::slug('Internet of Things'),
            ],
            [
                'name' => 'Augmented Reality',
                'icon' => 'ti ti-eye',
                'slug' => Str::slug('Augmented Reality'),
            ],
            [
                'name' => 'Virtual Reality',
                'icon' => 'ti ti-vr-headset',
                'slug' => Str::slug('Virtual Reality'),
            ],
        ];

        foreach ($course_categories as $category) {
            CourseCategory::create([
                'name' => $category['name'],
                'icon' => $category['icon'],
                'slug' => $category['slug'],
            ]);
        }
    }
}
