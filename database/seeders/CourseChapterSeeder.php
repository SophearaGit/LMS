<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\CourseChapter; // Ensure the correct model is imported
use Illuminate\Database\Seeder;

class CourseChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseChapters = [
            'Angular Web Development' => [
                'Introduction to Angular',
                'Components & Templates',
                'Routing & Navigation',
                'Services & HTTP Client',
                'Build an Angular Project',
            ],
            'Bootstrap 5 Responsive Design' => [
                'Getting Started with Bootstrap',
                'Grid System & Layout',
                'Bootstrap Components',
                'Forms & Utilities',
                'Responsive Website Project',
            ],
            'CSS3 Masterclass' => [
                'CSS Fundamentals',
                'Flexbox & Grid',
                'Animations & Transitions',
                'Responsive Design',
                'Portfolio Landing Page',
            ],
            'Gatsby.js Development' => [
                'Introduction to Gatsby',
                'Pages & Components',
                'GraphQL Data Layer',
                'Plugins & Optimization',
                'Deploying Gatsby Sites',
            ],
            'GraphQL API Development' => [
                'GraphQL Basics',
                'Queries & Mutations',
                'Apollo Server',
                'Authentication',
                'Build a GraphQL API',
            ],
            'Grunt Task Automation' => [
                'Introduction to Grunt',
                'Task Configuration',
                'Plugins',
                'Workflow Automation',
                'Production Build',
            ],
            'HTML5 Fundamentals' => [
                'HTML Document Structure',
                'Text, Links & Lists',
                'Images, Tables & Forms',
                'Semantic HTML',
                'Build Your First Website',
            ],
            'Modern JavaScript (ES6+)' => [
                'JavaScript Fundamentals',
                'Functions & Objects',
                'ES6 Features',
                'DOM Manipulation',
                'Mini JavaScript Project',
            ],
            'Laravel Full Stack Development' => [
                'Introduction to Laravel',
                'Routing & Controllers',
                'Blade & Eloquent ORM',
                'Authentication',
                'Complete Laravel Project',
            ],
            'Node.js Backend Development' => [
                'Node.js Fundamentals',
                'Express Framework',
                'RESTful APIs',
                'Authentication with JWT',
                'Deploy Node.js Application',
            ],
            'Python Programming' => [
                'Python Basics',
                'Functions & Modules',
                'Object-Oriented Programming',
                'Working with Files',
                'Python Final Project',
            ],
            'React.js Development' => [
                'React Fundamentals',
                'JSX & Components',
                'Hooks & State',
                'React Router',
                'Build a React Application',
            ],
            'SASS & SCSS' => [
                'Introduction to Sass',
                'Variables & Nesting',
                'Mixins & Functions',
                'Modular Architecture',
                'Compile & Optimize CSS',
            ],
            'Vue.js Development' => [
                'Vue Fundamentals',
                'Components',
                'Vue Router',
                'Pinia State Management',
                'Vue Final Project',
            ],
            'WordPress Website Development' => [
                'Introduction to WordPress',
                'Themes & Plugins',
                'Elementor Builder',
                'WooCommerce',
                'Launch a Business Website',
            ],
        ];
        foreach (Course::all() as $course) {
            // Get chapters based on the course title
            $chapters = $courseChapters[$course->title] ?? [
                'Introduction',
                'Core Concepts',
                'Hands-on Practice',
                'Final Project',
                'Course Review',
            ];
            foreach ($chapters as $index => $chapterTitle) {
                CourseChapter::create([
                    'title' => ($index + 1) . '. ' . $chapterTitle,
                    'instructor_id' => $course->instructor_id,
                    'course_id' => $course->id,
                    'order' => $index + 1,
                    'status' => 1,
                ]);
            }
        }
    }
}
