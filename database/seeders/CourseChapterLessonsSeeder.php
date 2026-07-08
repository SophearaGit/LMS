<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\CourseChapterLessons;
use Illuminate\Database\Seeder;
class CourseChapterLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chapterLessons = [
            // ==========================
            // Angular
            // ==========================
            'Introduction to Angular' => [
                'What is Angular?',
                'Installing Angular CLI',
                'Creating Your First Angular App',
            ],
            'Components & Templates' => [
                'Creating Components',
                'Working with Templates',
                'Data Binding',
            ],
            'Routing & Navigation' => [
                'Angular Router',
                'Route Parameters',
                'Lazy Loading Modules',
            ],
            'Services & HTTP Client' => [
                'Creating Services',
                'Dependency Injection',
                'Consuming REST APIs',
            ],
            'Build an Angular Project' => [
                'Project Structure',
                'Testing the Application',
                'Deployment',
            ],
            // ==========================
            // Bootstrap
            // ==========================
            'Getting Started with Bootstrap' => [
                'Installing Bootstrap',
                'Bootstrap CDN',
                'Project Setup',
            ],
            'Grid System & Layout' => [
                'Containers',
                'Grid System',
                'Responsive Breakpoints',
            ],
            'Bootstrap Components' => [
                'Buttons',
                'Cards',
                'Navbar',
            ],
            'Forms & Utilities' => [
                'Bootstrap Forms',
                'Spacing Utilities',
                'Flex Utilities',
            ],
            'Responsive Website Project' => [
                'Building the Homepage',
                'Responsive Layout',
                'Final Touches',
            ],
            // ==========================
            // CSS
            // ==========================
            'CSS Fundamentals' => [
                'Selectors',
                'Colors & Fonts',
                'Box Model',
            ],
            'Flexbox & Grid' => [
                'Flexbox Basics',
                'CSS Grid',
                'Responsive Layouts',
            ],
            'Animations & Transitions' => [
                'CSS Transitions',
                'Keyframes',
                'Hover Effects',
            ],
            'Responsive Design' => [
                'Media Queries',
                'Mobile First Design',
                'Responsive Images',
            ],
            'Portfolio Landing Page' => [
                'Building the Layout',
                'Styling Components',
                'Deployment',
            ],
            // ==========================
            // Gatsby
            // ==========================
            'Introduction to Gatsby' => [
                'What is Gatsby?',
                'Installing Gatsby CLI',
                'Creating Your First Site',
            ],
            'Pages & Components' => [
                'Pages',
                'Layouts',
                'Reusable Components',
            ],
            'GraphQL Data Layer' => [
                'GraphQL Basics',
                'Queries',
                'Static Data',
            ],
            'Plugins & Optimization' => [
                'Installing Plugins',
                'Image Optimization',
                'SEO',
            ],
            'Deploying Gatsby Sites' => [
                'Production Build',
                'Netlify Deployment',
                'Performance Testing',
            ],
            // ==========================
            // GraphQL
            // ==========================
            'GraphQL Basics' => [
                'What is GraphQL?',
                'Schema',
                'Types',
            ],
            'Queries & Mutations' => [
                'Queries',
                'Mutations',
                'Variables',
            ],
            'Apollo Server' => [
                'Installing Apollo',
                'Resolvers',
                'Context',
            ],
            'Authentication' => [
                'JWT Authentication',
                'Authorization',
                'Protecting Routes',
            ],
            'Build a GraphQL API' => [
                'CRUD API',
                'Testing',
                'Deployment',
            ],
            // ==========================
            // Grunt
            // ==========================
            'Introduction to Grunt' => [
                'Installing Grunt',
                'Grunt CLI',
                'Project Setup',
            ],
            'Task Configuration' => [
                'grunt.initConfig()',
                'Watching Files',
                'Loading Plugins',
            ],
            'Plugins' => [
                'grunt-contrib-watch',
                'grunt-contrib-cssmin',
                'grunt-contrib-uglify',
            ],
            'Workflow Automation' => [
                'Running Tasks',
                'Task Sequences',
                'Automation',
            ],
            'Production Build' => [
                'Minification',
                'Optimization',
                'Deployment',
            ],
            // ==========================
            // HTML
            // ==========================
            'HTML Document Structure' => [
                'HTML Boilerplate',
                'Head & Body',
                'HTML Elements',
            ],
            'Text, Links & Lists' => [
                'Paragraphs',
                'Hyperlinks',
                'Lists',
            ],
            'Images, Tables & Forms' => [
                'Images',
                'Tables',
                'Forms',
            ],
            'Semantic HTML' => [
                'Semantic Tags',
                'Accessibility',
                'SEO Basics',
            ],
            'Build Your First Website' => [
                'Homepage',
                'About Page',
                'Contact Page',
            ],
            // ==========================
            // JavaScript
            // ==========================
            'JavaScript Fundamentals' => [
                'Variables',
                'Data Types',
                'Operators',
            ],
            'Functions & Objects' => [
                'Functions',
                'Objects',
                'Arrays',
            ],
            'ES6 Features' => [
                'Arrow Functions',
                'Destructuring',
                'Spread Operator',
            ],
            'DOM Manipulation' => [
                'Selecting Elements',
                'Events',
                'Updating the DOM',
            ],
            'Mini JavaScript Project' => [
                'Planning',
                'Development',
                'Testing',
            ],
            // ==========================
            // Laravel
            // ==========================
            'Introduction to Laravel' => [
                'What is Laravel?',
                'Installing Laravel',
                'Laravel Directory Structure',
            ],
            'Routing & Controllers' => [
                'Basic Routing',
                'Route Parameters',
                'Controllers',
            ],
            'Blade & Eloquent ORM' => [
                'Blade Templates',
                'Eloquent Models',
                'Relationships',
            ],
            'Complete Laravel Project' => [
                'Building Features',
                'Testing',
                'Deployment',
            ],
            // ==========================
            // Node.js
            // ==========================
            'Node.js Fundamentals' => [
                'Installing Node.js',
                'Modules',
                'npm',
            ],
            'Express Framework' => [
                'Creating an Express App',
                'Middleware',
                'Routing',
            ],
            'RESTful APIs' => [
                'API Design',
                'CRUD Operations',
                'Testing APIs',
            ],
            'Authentication with JWT' => [
                'JWT Basics',
                'Login',
                'Protecting Routes',
            ],
            'Deploy Node.js Application' => [
                'Environment Variables',
                'Deployment',
                'PM2',
            ],
            // ==========================
            // Python
            // ==========================
            'Python Basics' => [
                'Installing Python',
                'Variables & Data Types',
                'Input & Output',
            ],
            'Functions & Modules' => [
                'Functions',
                'Arguments',
                'Modules',
            ],
            'Object-Oriented Programming' => [
                'Classes',
                'Objects',
                'Inheritance',
            ],
            'Working with Files' => [
                'Reading Files',
                'Writing Files',
                'JSON Files',
            ],
            'Python Final Project' => [
                'Planning',
                'Development',
                'Testing',
            ],
            // ==========================
            // React
            // ==========================
            'React Fundamentals' => [
                'Introduction to React',
                'Components',
                'Project Setup',
            ],
            'JSX & Components' => [
                'JSX',
                'Props',
                'Component Communication',
            ],
            'Hooks & State' => [
                'useState',
                'useEffect',
                'Custom Hooks',
            ],
            'React Router' => [
                'Installing Router',
                'Routes',
                'Navigation',
            ],
            'Build a React Application' => [
                'Building UI',
                'API Integration',
                'Deployment',
            ],
            // ==========================
            // Sass
            // ==========================
            'Introduction to Sass' => [
                'Installing Sass',
                'Compiling SCSS',
                'Project Setup',
            ],
            'Variables & Nesting' => [
                'Variables',
                'Nesting',
                'Partials',
            ],
            'Mixins & Functions' => [
                'Mixins',
                'Functions',
                'Extends',
            ],
            'Modular Architecture' => [
                'Folder Structure',
                'Imports',
                'Organization',
            ],
            'Compile & Optimize CSS' => [
                'Minification',
                'Source Maps',
                'Production Build',
            ],
            // ==========================
            // Vue
            // ==========================
            'Vue Fundamentals' => [
                'Installing Vue',
                'Vue Instance',
                'Templates',
            ],
            'Components' => [
                'Creating Components',
                'Props',
                'Events',
            ],
            'Vue Router' => [
                'Installing Router',
                'Routes',
                'Navigation Guards',
            ],
            'Pinia State Management' => [
                'Stores',
                'Actions',
                'Getters',
            ],
            'Vue Final Project' => [
                'Building App',
                'Testing',
                'Deployment',
            ],
            // ==========================
            // WordPress
            // ==========================
            'Introduction to WordPress' => [
                'What is WordPress?',
                'Installing WordPress',
                'Dashboard Overview',
            ],
            'Themes & Plugins' => [
                'Installing Themes',
                'Installing Plugins',
                'Customizing Appearance',
            ],
            'Elementor Builder' => [
                'Installing Elementor',
                'Building Pages',
                'Responsive Design',
            ],
            'WooCommerce' => [
                'Installing WooCommerce',
                'Creating Products',
                'Managing Orders',
            ],
            'Launch a Business Website' => [
                'SEO Basics',
                'Website Optimization',
                'Go Live',
            ],
        ];
        foreach (Course::all() as $course) {
            foreach ($course->chapters as $chapter) {
                $chapterTitle = preg_replace('/^\d+\.\s*/', '', $chapter->title);
                $lessons = $chapterLessons[$chapterTitle] ?? [
                    'Introduction',
                    'Core Concepts',
                    'Hands-on Practice',
                ];
                foreach ($lessons as $index => $lessonTitle) {
                    CourseChapterLessons::create([
                        'title' => ($index + 1) . '. ' . $lessonTitle,
                        'slug' => \Illuminate\Support\Str::slug($lessonTitle),
                        'description' => 'In this lesson, you will learn about ' . strtolower($lessonTitle) . ' through practical examples and hands-on exercises.',
                        'instructor_id' => $course->instructor_id,
                        'chapter_id' => $chapter->id,
                        'course_id' => $course->id,
                        'file_path' => 'https://youtu.be/I5kj-YsmWjM?si=XLcOB806tJKbhWvE',
                        'storage' => 'youtube',
                        'duration' => rand(5, 25),
                        'file_type' => 'video',
                        'order' => $index + 1,
                        'is_preview' => $index === 0 ? 1 : 0,
                        'status' => 1,
                        'lesson_type' => 'lesson',
                    ]);
                }
            }
        }
    }
}
