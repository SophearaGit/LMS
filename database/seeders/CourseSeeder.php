<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the IDs
        $category_arr_ids = array_map('intval', CourseCategory::whereNotNull('parent_id')->pluck('id')->toArray());
        $level_arr_ids = array_map('intval', CourseLevel::pluck('id')->toArray());
        $language_arr_ids = array_map('intval', CourseLanguage::pluck('id')->toArray());
        $courses = [
            [
                'image' => 'course-angular.webp',
                'title' => 'Angular Web Development',
                'description' => 'Learn Angular from the ground up and build modern, scalable single-page applications using TypeScript, components, routing, services, forms, and REST APIs.',
                'price' => 180,
            ],
            [
                'image' => 'course-bootstrap.webp',
                'title' => 'Bootstrap 5 Responsive Design',
                'description' => 'Master Bootstrap 5 to create responsive, mobile-first websites with modern layouts, utilities, and reusable UI components.',
                'price' => 90,
            ],
            [
                'image' => 'course-css.webp',
                'title' => 'CSS3 Masterclass',
                'description' => 'Build beautiful websites with Flexbox, Grid, animations, transitions, responsive layouts, and modern CSS techniques.',
                'price' => 80,
            ],
            [
                'image' => 'course-gatsby.webp',
                'title' => 'Gatsby.js Development',
                'description' => 'Create blazing-fast static websites with Gatsby, GraphQL, React, and modern JAMstack architecture.',
                'price' => 160,
            ],
            [
                'image' => 'course-graphql.webp',
                'title' => 'GraphQL API Development',
                'description' => 'Learn how to build flexible APIs using GraphQL, Apollo Server, queries, mutations, and subscriptions.',
                'price' => 170,
            ],
            [
                'image' => 'course-grunt.webp',
                'title' => 'Grunt Task Automation',
                'description' => 'Automate JavaScript workflows using Grunt including minification, compilation, linting, and deployment tasks.',
                'price' => 70,
            ],
            [
                'image' => 'course-html.webp',
                'title' => 'HTML5 Fundamentals',
                'description' => 'Learn HTML5 from scratch and build semantic, accessible, SEO-friendly web pages.',
                'price' => 60,
            ],
            [
                'image' => 'course-javascript.webp',
                'title' => 'Modern JavaScript (ES6+)',
                'description' => 'Master JavaScript including ES6 features, DOM manipulation, asynchronous programming, APIs, and object-oriented programming.',
                'price' => 150,
            ],
            [
                'image' => 'course-laravel.webp',
                'title' => 'Laravel Full Stack Development',
                'description' => 'Build professional web applications using Laravel, Blade, Eloquent ORM, authentication, REST APIs, queues, and deployment.',
                'price' => 220,
            ],
            [
                'image' => 'course-node.webp',
                'title' => 'Node.js Backend Development',
                'description' => 'Create scalable backend applications using Node.js, Express, JWT authentication, REST APIs, and MongoDB.',
                'price' => 190,
            ],
            [
                'image' => 'course-python.webp',
                'title' => 'Python Programming',
                'description' => 'Learn Python programming for automation, web development, data processing, and software engineering projects.',
                'price' => 170,
            ],
            [
                'image' => 'course-react.webp',
                'title' => 'React.js Development',
                'description' => 'Build interactive web applications using React, Hooks, Context API, React Router, and API integration.',
                'price' => 200,
            ],
            [
                'image' => 'course-sass.webp',
                'title' => 'SASS & SCSS',
                'description' => 'Improve your CSS workflow using SASS variables, mixins, nesting, functions, and modular architecture.',
                'price' => 75,
            ],
            [
                'image' => 'course-vue.webp',
                'title' => 'Vue.js Development',
                'description' => 'Learn Vue.js, Pinia, Vue Router, Composition API, and build fast, reactive web applications.',
                'price' => 180,
            ],
            [
                'image' => 'course-wordpress.webp',
                'title' => 'WordPress Website Development',
                'description' => 'Design professional websites using WordPress, Elementor, WooCommerce, themes, plugins, and SEO best practices.',
                'price' => 120,
            ],
        ];
        foreach ($courses as $index => $courseData) {
            Course::create([
                'instructor_id' => 2,
                'category_id' => $category_arr_ids[$index % count($category_arr_ids)],
                'course_type' => 'course',
                'title' => $courseData['title'],
                'slug' => Str::slug($courseData['title']) . '-' . time(),
                'thumbnail' => '/default-images/course/' . $courseData['image'],
                'seo_description' => Str::limit($courseData['description'], 150),
                'description' => $courseData['description'],
                'demo_video_storage' => 'youtube',
                'demo_video_source' => 'https://youtu.be/jTJvyKZDFsY?si=8hK2sRuAZZN5gQtY',
                'duration' => rand(120, 720),
                'capacity' => rand(20, 60),
                'price' => $courseData['price'],
                'discount' => rand(10, 30),
                'certificate' => 1,
                'qna' => 1,
                'status' => 'active',
                'is_approved' => 'approved',
                'course_level_id' => $level_arr_ids[array_rand($level_arr_ids)],
                'course_language_id' => $language_arr_ids[array_rand($language_arr_ids)],
            ]);
        }
    }
}
