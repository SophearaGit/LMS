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
        foreach ($this->courses() as $index => $courseData) {
            $overview = $this->buildOverview($courseData);
            // Already seeded? Refresh the text only, so this seeder can be re-run
            // without duplicating courses or touching their slug, price and enrollments.
            $existing = Course::withTrashed()->where('title', $courseData['title'])->first();
            if ($existing) {
                $existing->seo_description = Str::limit($courseData['description'], 150);
                $existing->description = $overview;
                $existing->save();
                continue;
            }
            Course::create([
                'instructor_id' => 2,
                'category_id' => $category_arr_ids[$index % count($category_arr_ids)],
                'course_type' => 'course',
                'title' => $courseData['title'],
                'slug' => Str::slug($courseData['title']) . '-' . time(),
                'thumbnail' => '/default-images/course/' . $courseData['image'],
                'seo_description' => Str::limit($courseData['description'], 150),
                'description' => $overview,
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

    /**
     * Build the HTML shown in the "Overview" tab of the course detail page.
     *
     * The front theme styles <ul> inside the overview box as a two-column
     * checklist with a green tick, so list items are kept short.
     */
    private function buildOverview(array $course): string
    {
        $checklist = fn (array $items) => '<ul>' . implode('', array_map(
            fn (string $item) => '<li>' . e($item) . '</li>',
            $items
        )) . '</ul>';
        $audience = implode('<br>', array_map(
            fn (array $line) => $line[0] . ' ' . e($line[1]),
            $course['audience']
        ));
        return implode("\n", [
            '<p>' . e($course['intro']) . '</p>',
            "<h4>🎯 What You'll Learn</h4>",
            $checklist($course['learn']),
            "<h4>🚀 What You'll Build</h4>",
            '<p>' . e($course['build']) . '</p>',
            '<h4>👥 Who This Course Is For</h4>',
            '<p>' . $audience . '</p>',
            '<h4>📋 Requirements</h4>',
            $checklist($course['requirements']),
            '<p>🎓 <strong>Certificate included.</strong> Complete every lesson to earn your certificate of completion.</p>',
        ]);
    }

    /**
     * Course catalogue. "description" is the short plain-text summary (used for SEO),
     * the other keys feed buildOverview(). Topics match CourseChapterSeeder
     * and CourseChapterLessonsSeeder.
     */
    private function courses(): array
    {
        return [
            [
                'image' => 'course-angular.webp',
                'title' => 'Angular Web Development',
                'description' => 'Learn Angular from the ground up and build modern, scalable single-page applications using TypeScript, components, routing, services, forms, and REST APIs.',
                'price' => 180,
                'intro' => 'Angular is Google\'s TypeScript framework for building large, maintainable single-page applications. This course takes you from installing the Angular CLI to shipping a complete app, covering components, data binding, routing, services and REST APIs along the way.',
                'learn' => [
                    'Set up projects with the Angular CLI',
                    'Build reusable components and templates',
                    'Bind data between class and template',
                    'Add routing, parameters and lazy loading',
                    'Use services and dependency injection',
                    'Consume REST APIs with HttpClient',
                ],
                'build' => 'A multi-page Angular application with routed views, shared services and live data from a REST API, which you will structure, test and deploy.',
                'audience' => [
                    ['💻', 'Web developers who know HTML, CSS and JavaScript and want a full framework'],
                    ['🔁', 'Developers moving to Angular from jQuery, React or Vue'],
                    ['🏢', 'Anyone aiming for front-end roles on large business applications'],
                    ['🎓', 'Students who need a solid framework for a final-year project'],
                ],
                'requirements' => [
                    'Basic HTML, CSS and JavaScript',
                    'Node.js and npm installed',
                    'No TypeScript experience needed',
                ],
            ],
            [
                'image' => 'course-bootstrap.webp',
                'title' => 'Bootstrap 5 Responsive Design',
                'description' => 'Master Bootstrap 5 to create responsive, mobile-first websites with modern layouts, utilities, and reusable UI components.',
                'price' => 90,
                'intro' => 'Bootstrap 5 is the most widely used CSS framework for building responsive, mobile-first websites quickly. You will learn the grid, the core components and the utility classes, then put them together in a complete responsive website.',
                'learn' => [
                    'Install Bootstrap or load it from a CDN',
                    'Lay out pages with containers and grid',
                    'Work with responsive breakpoints',
                    'Build navbars, cards and buttons',
                    'Style forms with Bootstrap classes',
                    'Use spacing and flex utilities',
                ],
                'build' => 'A fully responsive homepage that adapts from phone to desktop, built with the Bootstrap grid, navbar, cards and forms.',
                'audience' => [
                    ['🌱', 'Beginners who know basic HTML and CSS and want good-looking pages fast'],
                    ['⚙️', 'Back-end developers who need a presentable UI without writing CSS from scratch'],
                    ['🎨', 'Designers turning mockups into working pages'],
                    ['🎓', 'Students building project front ends on a deadline'],
                ],
                'requirements' => [
                    'Basic HTML and CSS',
                    'A code editor and a modern browser',
                    'No JavaScript knowledge required',
                ],
            ],
            [
                'image' => 'course-css.webp',
                'title' => 'CSS3 Masterclass',
                'description' => 'Build beautiful websites with Flexbox, Grid, animations, transitions, responsive layouts, and modern CSS techniques.',
                'price' => 80,
                'intro' => 'CSS is what turns plain markup into a polished website. This course covers the language properly, from selectors and the box model through Flexbox, Grid, animation and responsive design, so you can build layouts with confidence instead of trial and error.',
                'learn' => [
                    'Target elements with precise selectors',
                    'Understand the box model',
                    'Style text with colors and fonts',
                    'Build layouts with Flexbox and Grid',
                    'Animate with transitions and keyframes',
                    'Go mobile-first with media queries',
                ],
                'build' => 'A responsive portfolio landing page, laid out with Flexbox and Grid, finished with hover effects and animation, and deployed online.',
                'audience' => [
                    ['🌱', 'Beginners who know some HTML and are ready to style it'],
                    ['🧩', 'Developers who rely on frameworks and want to understand the CSS underneath'],
                    ['🎨', 'Designers who want to build what they design'],
                    ['🎓', 'Students who need a portfolio site of their own'],
                ],
                'requirements' => [
                    'Basic HTML',
                    'A code editor and a modern browser',
                    'No prior CSS experience needed',
                ],
            ],
            [
                'image' => 'course-gatsby.webp',
                'title' => 'Gatsby.js Development',
                'description' => 'Create blazing-fast static websites with Gatsby, GraphQL, React, and modern JAMstack architecture.',
                'price' => 160,
                'intro' => 'Gatsby is a React-based framework that pre-builds your site into fast static pages and pulls content in through a GraphQL data layer. You will build pages and layouts, query data, extend the site with plugins and deploy it.',
                'learn' => [
                    'Create a site with the Gatsby CLI',
                    'Build pages, layouts and components',
                    'Query data with GraphQL',
                    'Extend your site with plugins',
                    'Optimize images and SEO',
                    'Deploy to Netlify',
                ],
                'build' => 'A fast, SEO-friendly static site with shared layouts, GraphQL-sourced content and optimized images, built for production and deployed to Netlify.',
                'audience' => [
                    ['⚛️', 'React developers who want faster, SEO-friendly sites'],
                    ['✍️', 'Bloggers and content creators who want a site they fully control'],
                    ['💼', 'Freelancers building marketing sites and portfolios for clients'],
                    ['🚀', 'Developers curious about the Jamstack approach'],
                ],
                'requirements' => [
                    'JavaScript and basic React',
                    'Node.js and npm installed',
                    'No GraphQL experience needed',
                ],
            ],
            [
                'image' => 'course-graphql.webp',
                'title' => 'GraphQL API Development',
                'description' => 'Learn how to build flexible APIs using GraphQL, Apollo Server, queries, mutations, and subscriptions.',
                'price' => 170,
                'intro' => 'GraphQL lets clients ask for exactly the data they need from a single endpoint. In this course you will design a schema, write queries and mutations, build a server with Apollo, and secure it with JWT authentication.',
                'learn' => [
                    'Design a schema with types',
                    'Write queries, mutations and variables',
                    'Set up Apollo Server',
                    'Write resolvers and use context',
                    'Add JWT authentication',
                    'Authorize users and protect data',
                ],
                'build' => 'A complete CRUD GraphQL API on Apollo Server with JWT login and protected operations, tested and deployed.',
                'audience' => [
                    ['🔧', 'Back-end developers who build REST APIs and want to add GraphQL'],
                    ['🖥️', 'Front-end developers who want to understand the API they consume'],
                    ['🧱', 'Full-stack developers designing data-heavy applications'],
                    ['🎓', 'Students who want a modern API for their project'],
                ],
                'requirements' => [
                    'Solid JavaScript basics',
                    'Node.js and npm installed',
                    'Basic idea of how web APIs work',
                ],
            ],
            [
                'image' => 'course-grunt.webp',
                'title' => 'Grunt Task Automation',
                'description' => 'Automate JavaScript workflows using Grunt including minification, compilation, linting, and deployment tasks.',
                'price' => 70,
                'intro' => 'Grunt is a JavaScript task runner that automates repetitive front-end chores such as minifying, compiling and watching files. Many established projects still rely on it, so being able to read, write and maintain a Gruntfile is a practical skill. You will configure tasks, load plugins and chain everything into a one-command production build.',
                'learn' => [
                    'Install Grunt and the Grunt CLI',
                    'Configure tasks with grunt.initConfig()',
                    'Load and configure plugins',
                    'Rebuild automatically on file changes',
                    'Minify CSS and JavaScript',
                    'Chain tasks into one build command',
                ],
                'build' => 'An automated workflow that watches your source files, minifies CSS and JavaScript, and produces an optimized production build with a single command.',
                'audience' => [
                    ['🛠️', 'Front-end developers tired of repeating manual build steps'],
                    ['🗂️', 'Developers maintaining projects that already use Grunt'],
                    ['🌱', 'Beginners who want to understand how build tools work'],
                    ['🎓', 'Students learning the front-end tooling landscape'],
                ],
                'requirements' => [
                    'Basic JavaScript',
                    'Node.js and npm installed',
                    'Basic command-line use',
                ],
            ],
            [
                'image' => 'course-html.webp',
                'title' => 'HTML5 Fundamentals',
                'description' => 'Learn HTML5 from scratch and build semantic, accessible, SEO-friendly web pages.',
                'price' => 60,
                'intro' => 'Every website starts with HTML. This beginner course teaches you to write clean, semantic markup, from the basic document structure to tables and forms, with accessibility and SEO built in from the first page.',
                'learn' => [
                    'Structure a valid HTML document',
                    'Format text, links and lists',
                    'Add images and tables',
                    'Build forms to collect user input',
                    'Use semantic tags correctly',
                    'Apply accessibility and SEO basics',
                ],
                'build' => 'Your first multi-page website, with a homepage, an about page and a contact page linked together.',
                'audience' => [
                    ['🌱', 'Complete beginners with no coding experience'],
                    ['🎨', 'Designers and content writers who work with web pages'],
                    ['🧭', 'Anyone starting the path to web development'],
                    ['🎓', 'Students who need the foundation before CSS and JavaScript'],
                ],
                'requirements' => [
                    'No experience needed',
                    'A computer with a modern browser',
                    'A free code editor such as VS Code',
                ],
            ],
            [
                'image' => 'course-javascript.webp',
                'title' => 'Modern JavaScript (ES6+)',
                'description' => 'Master JavaScript including ES6 features, DOM manipulation, asynchronous programming, APIs, and object-oriented programming.',
                'price' => 150,
                'intro' => 'JavaScript is the language of the web, and modern JavaScript is far cleaner than the version many old tutorials still teach. Starting from variables and data types, you will work up to ES6 syntax and DOM manipulation, writing real code in every lesson.',
                'learn' => [
                    'Work with variables, types and operators',
                    'Use functions, objects and arrays',
                    'Write concise arrow functions',
                    'Use destructuring and spread syntax',
                    'Select and update DOM elements',
                    'Respond to user events',
                ],
                'build' => 'A small interactive browser app that you plan, develop and test yourself, using ES6 syntax and DOM events.',
                'audience' => [
                    ['🌱', 'Beginners who know basic HTML and CSS'],
                    ['🔄', 'Developers refreshing older JavaScript habits'],
                    ['⚛️', 'Anyone preparing for React, Vue or Angular'],
                    ['🎓', 'Students who want solid programming fundamentals'],
                ],
                'requirements' => [
                    'Basic HTML and CSS',
                    'A code editor and a modern browser',
                    'No programming experience needed',
                ],
            ],
            [
                'image' => 'course-laravel.webp',
                'title' => 'Laravel Full Stack Development',
                'description' => 'Build professional web applications using Laravel, Blade, Eloquent ORM, authentication, REST APIs, queues, and deployment.',
                'price' => 220,
                'intro' => 'Laravel is the most popular PHP framework, known for its clear syntax and batteries-included tooling. This course walks through the full request cycle, from routes and controllers to Blade views and Eloquent models, then adds authentication and takes a complete project to deployment.',
                'learn' => [
                    'Install Laravel and navigate a project',
                    'Define routes and controllers',
                    'Build views with Blade templates',
                    'Model data with Eloquent ORM',
                    'Define model relationships',
                    'Add login and protect routes',
                ],
                'build' => 'A complete database-driven web application with authentication, which you will build feature by feature, test and deploy.',
                'audience' => [
                    ['🐘', 'PHP developers ready to move to a modern framework'],
                    ['🧱', 'Developers who want to build full-stack apps with one tool'],
                    ['💼', 'Freelancers building business systems for clients'],
                    ['🎓', 'Students planning a Laravel-based thesis or final project'],
                ],
                'requirements' => [
                    'PHP fundamentals, including basic OOP',
                    'Basic HTML, CSS and SQL',
                    'PHP, Composer and MySQL installed',
                ],
            ],
            [
                'image' => 'course-node.webp',
                'title' => 'Node.js Backend Development',
                'description' => 'Create scalable backend applications using Node.js, Express, JWT authentication, REST APIs, and MongoDB.',
                'price' => 190,
                'intro' => 'Node.js lets you run JavaScript on the server, and with Express it is one of the fastest ways to build an API. You will design RESTful endpoints, secure them with JWT, and deploy the finished service with PM2.',
                'learn' => [
                    'Use Node.js modules and npm',
                    'Create an Express application',
                    'Write middleware and routes',
                    'Design RESTful CRUD endpoints',
                    'Secure routes with JWT login',
                    'Deploy and run apps with PM2',
                ],
                'build' => 'A REST API with full CRUD operations, JWT login and protected routes, configured with environment variables and running in production under PM2.',
                'audience' => [
                    ['🖥️', 'Front-end developers who want to go full-stack with JavaScript'],
                    ['🔧', 'Back-end developers coming from PHP, Java or Python'],
                    ['📱', 'App developers who need their own API'],
                    ['🎓', 'Students building the back end for a project'],
                ],
                'requirements' => [
                    'Solid JavaScript basics',
                    'Node.js and npm installed',
                    'Basic knowledge of HTTP requests',
                ],
            ],
            [
                'image' => 'course-python.webp',
                'title' => 'Python Programming',
                'description' => 'Learn Python programming for automation, web development, data processing, and software engineering projects.',
                'price' => 170,
                'intro' => 'Python\'s readable syntax makes it one of the most recommended first programming languages, and it is used everywhere from automation to data science. This course builds real fundamentals: data types, functions, modules, object-oriented programming and file handling.',
                'learn' => [
                    'Work with variables and data types',
                    'Handle input and output',
                    'Write functions and reusable modules',
                    'Build classes and use inheritance',
                    'Read and write files',
                    'Work with JSON data',
                ],
                'build' => 'A final project of your own that you plan, write and test, combining functions, classes and file handling.',
                'audience' => [
                    ['🌱', 'Complete beginners to programming'],
                    ['🤖', 'Professionals who want to automate repetitive tasks'],
                    ['📊', 'Future data analysts who need Python first'],
                    ['🎓', 'Students taking their first programming course'],
                ],
                'requirements' => [
                    'No programming experience needed',
                    'A Windows, macOS or Linux computer',
                    'Python 3 (installed in the first lesson)',
                ],
            ],
            [
                'image' => 'course-react.webp',
                'title' => 'React.js Development',
                'description' => 'Build interactive web applications using React, Hooks, Context API, React Router, and API integration.',
                'price' => 200,
                'intro' => 'React is the most widely used library for building user interfaces. You will learn to think in components, manage state with Hooks, add client-side routing and connect your UI to a real API.',
                'learn' => [
                    'Set up a React project',
                    'Write JSX and build components',
                    'Pass data with props',
                    'Manage state with useState and useEffect',
                    'Write your own custom Hooks',
                    'Add pages with React Router',
                ],
                'build' => 'A multi-page React application with a component-based UI, client-side routing and live data from an API, deployed to the web.',
                'audience' => [
                    ['💻', 'Developers comfortable with JavaScript who want a modern UI library'],
                    ['🔄', 'Developers moving on from jQuery or server-rendered pages'],
                    ['💼', 'Job seekers targeting front-end roles'],
                    ['🎓', 'Students who need an interactive front end for a project'],
                ],
                'requirements' => [
                    'HTML, CSS and modern JavaScript (ES6)',
                    'Node.js and npm installed',
                    'A code editor such as VS Code',
                ],
            ],
            [
                'image' => 'course-sass.webp',
                'title' => 'SASS & SCSS',
                'description' => 'Improve your CSS workflow using SASS variables, mixins, nesting, functions, and modular architecture.',
                'price' => 75,
                'intro' => 'Sass extends CSS with variables, nesting, mixins and functions, so large stylesheets stay organized and easy to change. You will learn the SCSS syntax, structure your styles into partials, and compile them into optimized CSS for production.',
                'learn' => [
                    'Install Sass and compile SCSS',
                    'Use variables and nesting',
                    'Split styles into partials',
                    'Write mixins and functions',
                    'Reuse styles with @extend',
                    'Generate minified CSS and source maps',
                ],
                'build' => 'A modular SCSS codebase with a clear folder structure, compiled into a minified production stylesheet with source maps.',
                'audience' => [
                    ['🎨', 'Front-end developers whose CSS files have grown hard to manage'],
                    ['🧩', 'Developers who customize Bootstrap or other Sass-based frameworks'],
                    ['👥', 'Teams that want consistent, reusable styles'],
                    ['🎓', 'Students who already know CSS and want the next step'],
                ],
                'requirements' => [
                    'Good working knowledge of CSS',
                    'Node.js and npm installed',
                    'A code editor such as VS Code',
                ],
            ],
            [
                'image' => 'course-vue.webp',
                'title' => 'Vue.js Development',
                'description' => 'Learn Vue.js, Pinia, Vue Router, Composition API, and build fast, reactive web applications.',
                'price' => 180,
                'intro' => 'Vue is a progressive JavaScript framework that is approachable for beginners and powerful enough for large applications. You will build components, add routing with Vue Router and manage shared state with Pinia.',
                'learn' => [
                    'Set up a Vue project',
                    'Write reactive templates',
                    'Build components with props and events',
                    'Add pages with Vue Router',
                    'Protect pages with navigation guards',
                    'Manage state with Pinia stores',
                ],
                'build' => 'A complete Vue application with routed pages, guarded routes and a Pinia store, which you will test and deploy.',
                'audience' => [
                    ['🌱', 'JavaScript developers looking for an approachable framework'],
                    ['🐘', 'Laravel and PHP developers who want a reactive front end'],
                    ['🔄', 'Developers comparing Vue with React or Angular'],
                    ['🎓', 'Students building a single-page app for a project'],
                ],
                'requirements' => [
                    'HTML, CSS and JavaScript basics',
                    'Node.js and npm installed',
                    'A code editor such as VS Code',
                ],
            ],
            [
                'image' => 'course-wordpress.webp',
                'title' => 'WordPress Website Development',
                'description' => 'Design professional websites using WordPress, Elementor, WooCommerce, themes, plugins, and SEO best practices.',
                'price' => 120,
                'intro' => 'WordPress powers more than 40% of all websites, and you can build a professional one without writing code. You will install and configure WordPress, design pages with Elementor, add an online store with WooCommerce and prepare the site for launch.',
                'learn' => [
                    'Install and set up WordPress',
                    'Choose and customize themes',
                    'Extend your site with plugins',
                    'Design pages with Elementor',
                    'Sell products with WooCommerce',
                    'Improve SEO and site speed',
                ],
                'build' => 'A complete business website with custom-designed pages, a working online store and SEO in place, taken live at the end of the course.',
                'audience' => [
                    ['🏪', 'Business owners who want to run their own website'],
                    ['💼', 'Freelancers who want to build sites for clients'],
                    ['🛒', 'Anyone planning to sell products online'],
                    ['✍️', 'Bloggers and creators who want a professional home online'],
                ],
                'requirements' => [
                    'No coding experience needed',
                    'A computer with an internet connection',
                    'Basic computer and browser skills',
                ],
            ],
        ];
    }
}
