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
                'icon' => 'ti ti-brand-html5',
            ],
            [
                'name' => 'Mobile Development',
                'icon' => 'ti ti-device-mobile',
            ],
            [
                'name' => 'Data Science',
                'icon' => 'ti ti-chart-pie',
            ],
            [
                'name' => 'Machine Learning',
                'icon' => 'ti ti-brain',
            ],
            [
                'name' => 'Cloud Computing',
                'icon' => 'ti ti-cloud',
            ],
            [
                'name' => 'Cyber Security',
                'icon' => 'ti ti-shield-check',
            ],
            [
                'name' => 'Digital Marketing',
                'icon' => 'ti ti-chart-bar',
            ],
            [
                'name' => 'Graphic Design',
                'icon' => 'ti ti-palette',
            ],
            [
                'name' => 'UI/UX Design',
                'icon' => 'ti ti-layout-grid',
            ],
            [
                'name' => 'Game Development',
                'icon' => 'ti ti-device-gamepad-2',
            ],
            [
                'name' => 'Blockchain',
                'icon' => 'ti ti-lock',
            ],
            [
                'name' => 'DevOps',
                'icon' => 'ti ti-server',
            ],
            [
                'name' => 'Software Testing',
                'icon' => 'ti ti-checkup-list',
            ],
            [
                'name' => 'Project Management',
                'icon' => 'ti ti-clipboard-list',
            ],
            [
                'name' => 'Business Analysis',
                'icon' => 'ti ti-briefcase',
            ],
            [
                'name' => 'Artificial Intelligence',
                'icon' => 'ti ti-robot',
            ],
            [
                'name' => 'Internet of Things',
                'icon' => 'ti ti-network',
            ],
            [
                'name' => 'Augmented Reality',
                'icon' => 'ti ti-eye',
            ],
            [
                'name' => 'Virtual Reality',
                'icon' => 'ti ti-badge-vr',
            ],
            [
                'name' => 'html5',
                'icon' => 'ti ti-brand-html5',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'css3',
                'icon' => 'ti ti-brand-css3',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'javascript',
                'icon' => 'ti ti-brand-javascript',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'php',
                'icon' => 'ti ti-brand-php',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'python',
                'icon' => 'ti ti-brand-python',
                'parent_id' => 3, // Assuming 'Data Science' is the parent category
            ],
            [
                'name' => 'java',
                'icon' => 'ti ti-brand-java',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'csharp',
                'icon' => 'ti ti-brand-csharp',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'ruby',
                'icon' => 'ti ti-brand-ruby',
                'parent_id' => 1, // Assuming 'Web Development' is the parent category
            ],
            [
                'name' => 'swift',
                'icon' => 'ti ti-brand-swift',
                'parent_id' => 2, // Assuming 'Mobile Development' is the parent category
            ],
            [
                'name' => 'kotlin',
                'icon' => 'ti ti-brand-kotlin',
                'parent_id' => 2, // Assuming 'Mobile Development' is the parent category
            ],
            [
                'name' => 'flutter',
                'icon' => 'ti ti-brand-flutter',
                'parent_id' => 2, // Assuming 'Mobile Development' is the parent category
            ],
            [
                'name' => 'react-native',
                'icon' => 'ti ti-brand-react',
                'parent_id' => 2, // Assuming 'Mobile Development' is the parent category
            ],
            [
                'name' => 'sql',
                'icon' => 'ti ti-brand-sql',
                'parent_id' => 3, // Assuming 'Data Science' is the parent category
            ],
            [
                'name' => 'nosql',
                'icon' => 'ti ti-brand-nosql',
                'parent_id' => 3, // Assuming 'Data Science' is the parent category
            ],
            [
                'name' => 'mongodb',
                'icon' => 'ti ti-brand-mongodb',
                'parent_id' => 3, // Assuming 'Data Science' is the parent category
            ],
            [
                'name' => 'tensorflow',
                'icon' => 'ti ti-brand-tensorflow',
                'parent_id' => 4, // Assuming 'Machine Learning' is the parent category
            ],
            [
                'name' => 'pytorch',
                'icon' => 'ti ti-brand-pytorch',
                'parent_id' => 4, // Assuming 'Machine Learning' is the parent category
            ],
            [
                'name' => 'aws',
                'icon' => 'ti ti-brand-aws',
                'parent_id' => 5, // Assuming 'Cloud Computing' is the parent category
            ],
            [
                'name' => 'azure',
                'icon' => 'ti ti-brand-azure',
                'parent_id' => 5, // Assuming 'Cloud Computing' is the parent category
            ],
            [
                'name' => 'gcp',
                'icon' => 'ti ti-brand-gcp',
                'parent_id' => 5, // Assuming 'Cloud Computing' is the parent category
            ],
            [
                'name' => 'ethical-hacking',
                'icon' => 'ti ti-shield-lock',
                'parent_id' => 6, // Assuming 'Cyber Security' is the parent category
            ],
            [
                'name' => 'penetration-testing',
                'icon' => 'ti ti-shield-check',
                'parent_id' => 6, // Assuming 'Cyber Security' is the parent category
            ],
            [
                'name' => 'seo',
                'icon' => 'ti ti-search',
                'parent_id' => 7, // Assuming 'Digital Marketing' is the parent category
            ],
            [
                'name' => 'content-marketing',
                'icon' => 'ti ti-pencil',
                'parent_id' => 7, // Assuming 'Digital Marketing' is the parent category
            ],
            [
                'name' => 'adobe-photoshop',
                'icon' => 'ti ti-brand-adobe',
                'parent_id' => 8, // Assuming 'Graphic Design' is the parent category
            ],
            [
                'name' => 'adobe-illustrator',
                'icon' => 'ti ti-brand-adobe-illustrator',
                'parent_id' => 8, // Assuming 'Graphic Design' is the parent category
            ],
        ];

        foreach ($course_categories as $category) {
            CourseCategory::create([
                'name' => $category['name'],
                'parent_id' => $category['parent_id'] ?? null,
                'show_at_trending' => 1,
                'image' => '/default-images/categoryDefaultImages/default.png',
                'icon' => $category['icon'],
                'slug' => Str::slug($category['name']),
            ]);
        }
    }
}
