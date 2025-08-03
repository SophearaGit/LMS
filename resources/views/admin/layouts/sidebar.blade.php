<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset(config('settings.site_logo')) }}" width="110" height="32" alt="CAIDT"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset(auth()->guard('admin')->user()->image) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->guard('admin')->user()->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.site-settings.index') }}" class="dropdown-item">Settings</a>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();getElementById('logout').submit();"
                        class="dropdown-item">Logout</a>
                    <form method="POST" id="logout" action="{{ route('admin.logout') }}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}"
                        style="background-color: {{ Route::is('admin.dashboard') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.dashboard') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-home" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.instructor-requests.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.instructor-requests.index') ? 'active' : '' }}"
                        href="{{ route('admin.instructor-requests.index') }}"
                        style="background-color: {{ Route::is('admin.instructor-requests.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.instructor-requests.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-user-exclamation" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Instructor Requests
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.orders.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.orders.index') ? 'active' : '' }}"
                        href="{{ route('admin.orders.index') }}"
                        style="background-color: {{ Route::is('admin.orders.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.orders.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-shopping-cart" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Orders
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.payout-gateways.*') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.payout-gateways.*') ? 'active' : '' }}"
                        href="{{ route('admin.payout-gateways.index') }}"
                        style="background-color: {{ Route::is('admin.payout-gateways.*') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.payout-gateways.*') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-wallet" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Payout Gateways
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.withdraw-request.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.withdraw-request.index') ? 'active' : '' }}"
                        href="{{ route('admin.withdraw-request.index') }}"
                        style="background-color: {{ Route::is('admin.withdraw-request.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.withdraw-request.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-message-circle-dollar">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M13.16 19.914a9.94 9.94 0 0 1 -5.46 -.914l-4.7 1l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c1.384 1.181 2.26 2.672 2.603 4.243" />
                                <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                <path d="M19 21v1m0 -8v1" />
                            </svg>
                        </span>
                        <span class="nav-link-title mt-1">
                            Payout Requests
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.review.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.review.index') ? 'active' : '' }}"
                        href="{{ route('admin.review.index') }}"
                        style="background-color: {{ Route::is('admin.review.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.review.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-message" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Reviews
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.payment-settings.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.payment-settings.index') ? 'active' : '' }}"
                        href="{{ route('admin.payment-settings.index') }}"
                        style="background-color: {{ Route::is('admin.payment-settings.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.payment-settings.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-credit-card" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Payment Settings
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::is('admin.course-languages.*') ||
                    Route::is('admin.course-levels.*') ||
                    Route::is('admin.course-categories.*') ||
                    Route::is('admin.course-sub-categories.*') ||
                    Route::is('admin.courses.*')
                        ? 'active'
                        : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.course-languages.*') ||
                        Route::is('admin.course-levels.*') ||
                        Route::is('admin.course-categories.*') ||
                        Route::is('admin.course-sub-categories.*') ||
                        Route::is('admin.courses.*')
                            ? 'true'
                            : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block dropdown-menu me-2">
                            <i class="ti ti-books" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Course Management
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.course-languages.*') || Route::is('admin.course-levels.*') || Route::is('admin.course-categories.*') || Route::is('admin.course-sub-categories.*') || Route::is('admin.courses.*') ? 'show' : '' }}"
                        {{ Route::is('admin.course-languages.*') || Route::is('admin.course-levels.*') || Route::is('admin.course-categories.*') || Route::is('admin.course-sub-categories.*') || Route::is('admin.courses.*') ? 'data-bs-popper="static"' : '' }}>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.courses.index') ? 'active' : '' }} "
                                    href="{{ route('admin.courses.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none {{ Route::is('admin.courses.index') ? 'text-white' : '' }} d-lg-inline-block">
                                        <i class="ti ti-book" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.courses.index') ? 'text-white' : '' }} mt-1">
                                        Courses
                                    </span>
                                </a>

                                <a class="dropdown-item {{ Route::is('admin.course-languages.index') ? 'active' : '' }} "
                                    href="{{ route('admin.course-languages.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.course-languages.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-language" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.course-languages.*') ? 'text-white' : '' }} mt-1">
                                        Course Languages
                                    </span>
                                </a>

                                <a class="dropdown-item {{ Route::is('admin.course-levels.index') ? 'active' : '' }} "
                                    href="{{ route('admin.course-levels.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.course-levels.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-clipboard-list" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.course-levels.*') ? 'text-white' : '' }} mt-1">
                                        Course Levels
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.course-categories.index') ? 'active' : '' }} "
                                    href="{{ route('admin.course-categories.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.course-categories.*') || Route::is('admin.course-sub-categories.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-category" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.course-categories.*') || Route::is('admin.course-sub-categories.*') ? 'text-white' : '' }} mt-1">
                                        Course Categories
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li
                    class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block dropdown-menu me-2">
                            <i class="ti ti-notebook" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1 ">
                            Content Management
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') ? 'show' : '' }}"
                        {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') ? 'data-bs-popper="static"' : '' }}>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.blog.index') ? 'active' : '' }} "
                                    href="{{ route('admin.blog.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.blog.*') ? 'text-white' : '' }} ">
                                        <i class="ti ti-article" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.blog.*') ? 'text-white' : '' }} mt-1">
                                        Blog
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.blog-category.index') ? 'active' : '' }} "
                                    href="{{ route('admin.blog-category.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.blog-category.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-category" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title {{ Route::is('admin.blog-category.*') ? 'text-white' : '' }} mt-1">
                                        Blog Categories
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li
                    class="nav-item dropdown {{ Route::is('admin.hero.*') || Route::is('admin.features.*') || Route::is('admin.about-section.*') || Route::is('admin.latest-courses.*') || Route::is('admin.become-instructor.*') || Route::is('admin.video-section.*') || Route::is('admin.brand-section.*') || Route::is('admin.featured-instructor-section.*') || Route::is('admin.testimonial-section.*') || Route::is('admin.counter-section.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.hero.*') || Route::is('admin.features.*') || Route::is('admin.about-section.*') || Route::is('admin.latest-courses.*') || Route::is('admin.become-instructor.*') || Route::is('admin.video-section.*') || Route::is('admin.brand-section.*') || Route::is('admin.featured-instructor-section.*') || Route::is('admin.testimonial-section.*') || Route::is('admin.counter-section.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block dropdown-menu me-2">
                            <i class="ti ti-versions" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Sections
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.hero.*') || Route::is('admin.features.*') || Route::is('admin.about-section.*') || Route::is('admin.latest-courses.*') || Route::is('admin.become-instructor.*') || Route::is('admin.video-section.*') || Route::is('admin.brand-section.*') || Route::is('admin.featured-instructor-section.*') || Route::is('admin.testimonial-section.*') || Route::is('admin.counter-section.*') ? 'show' : '' }}"
                        {{ Route::is('admin.hero.*') || Route::is('admin.features.*') || Route::is('admin.about-section.*') || Route::is('admin.latest-courses.*') || Route::is('admin.become-instructor.*') || Route::is('admin.video-section.*') || Route::is('admin.brand-section.*') || Route::is('admin.featured-instructor-section.*') || Route::is('admin.testimonial-section.*') || Route::is('admin.counter-section.*') ? 'data-bs-popper="static"' : '' }}>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.hero.index') ? 'active' : '' }} "
                                    href="{{ route('admin.hero.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.hero.index') ? 'text-white' : '' }}  ">
                                        <i class="ti ti-layout-navbar" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.hero.index') ? 'text-white' : '' }} ">
                                        Hero
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.features.index') ? 'active' : '' }} "
                                    href="{{ route('admin.features.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.features.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-layout-grid" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.features.index') ? 'text-white' : '' }}">
                                        Feature
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.about-section.index') ? 'active' : '' }}"
                                    href="{{ route('admin.about-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.about-section.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-info-circle" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.about-section.index') ? 'text-white' : '' }}">
                                        About Us
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.latest-courses.index') ? 'active' : '' }} "
                                    href="{{ route('admin.latest-courses.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.latest-courses.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-home-star" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.latest-courses.index') ? 'text-white' : '' }}">
                                        Latest Courses
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.become-instructor.index') ? 'active' : '' }} "
                                    href="{{ route('admin.become-instructor.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.become-instructor.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-user-plus" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.become-instructor.index') ? 'text-white' : '' }}">
                                        Become Instructor
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.video-section.index') ? 'active' : '' }} "
                                    href="{{ route('admin.video-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.video-section.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-video" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.video-section.index') ? 'text-white' : '' }}">
                                        Video Section
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.brand-section.*') ? 'active' : '' }} "
                                    href="{{ route('admin.brand-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.brand-section.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-heart-handshake" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.brand-section.*') ? 'text-white' : '' }}">
                                        Brand Section
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.featured-instructor-section.index') ? 'active' : '' }} "
                                    href="{{ route('admin.featured-instructor-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.featured-instructor-section.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-star" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.featured-instructor-section.index') ? 'text-white' : '' }}">
                                        Featured Instructor
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.testimonial-section.*') ? 'active' : '' }} "
                                    href="{{ route('admin.testimonial-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.testimonial-section.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-message-2" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.testimonial-section.*') ? 'text-white' : '' }}">
                                        Testimonial Section
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.counter-section.index') ? 'active' : '' }} "
                                    href="{{ route('admin.counter-section.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.counter-section.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-123" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.counter-section.index') ? 'text-white' : '' }}">
                                        Counter Section
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li
                    class="nav-item dropdown {{ Route::is('admin.contact-us.*') || Route::is('admin.contact-setting.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.contact-us.*') || Route::is('admin.contact-setting.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block dropdown-menu me-2">
                            <i class="ti ti-mail" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Contact Us
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.contact-us.*') || Route::is('admin.contact-setting.*') ? 'show' : '' }}"
                        {{ Route::is('admin.contact-us.*') || Route::is('admin.contact-setting.*') ? 'data-bs-popper="static"' : '' }}>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.contact-us.index') ? 'active' : '' }} "
                                    href="{{ route('admin.contact-us.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.contact-us.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-mail-opened" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.contact-us.*') ? 'text-white' : '' }}">
                                        Contact Card
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.contact-setting.index') || Route::is('admin.contact-setting.*') ? 'active' : '' }} "
                                    href="{{ route('admin.contact-setting.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.contact-setting.index') || Route::is('admin.contact-setting.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-phone-pause" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.contact-setting.index') || Route::is('admin.contact-setting.*') ? 'text-white' : '' }}">
                                        Contact Setting
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li
                    class="nav-item dropdown {{ Route::is('admin.topbar.*') || Route::is('admin.footer.*') || Route::is('admin.social-links.*') || Route::is('admin.column-one.*') || Route::is('admin.column-two.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button"
                        aria-expanded="{{ Route::is('admin.topbar.*') || Route::is('admin.footer.*') || Route::is('admin.social-links.*') || Route::is('admin.column-one.*') || Route::is('admin.column-two.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block dropdown-menu me-2 ">
                            <i class="ti ti-layout-navbar" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Header / Footer
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('admin.topbar.*') || Route::is('admin.footer.*') || Route::is('admin.social-links.*') || Route::is('admin.column-one.*') || Route::is('admin.column-two.*') ? 'show' : '' }}"
                        {{ Route::is('admin.topbar.*') || Route::is('admin.footer.*') || Route::is('admin.social-links.*') || Route::is('admin.column-one.*') || Route::is('admin.column-two.*') ? 'data-bs-popper="static"' : '' }}>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::is('admin.topbar.index') ? 'active' : '' }} "
                                    href="{{ route('admin.topbar.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.topbar.index') ? 'text-white' : '' }}">
                                        <i class="ti ti-layout-navbar-collapse" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.topbar.index') ? 'text-white' : '' }}">
                                        Top Bar
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.footer.index') ? 'active' : '' }} "
                                    href="{{ route('admin.footer.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.footer.index') ? 'text-white' : '' }} ">
                                        <i class="ti ti-layout-bottombar" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.footer.index') ? 'text-white' : '' }}">
                                        Footer
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.social-links.*') ? 'active' : '' }} "
                                    href="{{ route('admin.social-links.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.social-links.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-brand-telegram" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.social-links.*') ? 'text-white' : '' }}">
                                        Social Links
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.column-one.*') ? 'active' : '' }} "
                                    href="{{ route('admin.column-one.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.column-one.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-box-multiple-1" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.column-one.*') ? 'text-white' : '' }}">
                                        Column One
                                    </span>
                                </a>
                                <a class="dropdown-item {{ Route::is('admin.column-two.*') ? 'active' : '' }} "
                                    href="{{ route('admin.column-two.index') }}">
                                    <span
                                        class="nav-link-icon d-md-none d-lg-inline-block {{ Route::is('admin.column-two.*') ? 'text-white' : '' }}">
                                        <i class="ti ti-box-multiple-2" style="font-size: 20px;"></i>
                                    </span>
                                    <span
                                        class="nav-link-title mt-1 {{ Route::is('admin.column-two.*') ? 'text-white' : '' }}">
                                        Column Two
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ Route::is('admin.custom-page.*') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.custom-page.*') ? 'active' : '' }}"
                        href="{{ route('admin.custom-page.index') }}"
                        style="background-color: {{ Route::is('admin.custom-page.*') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.custom-page.*') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-template" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Custom Pages
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.certificate-builder.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.certificate-builder.index') ? 'active' : '' }}"
                        href="{{ route('admin.certificate-builder.index') }}"
                        style="background-color: {{ Route::is('admin.certificate-builder.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.certificate-builder.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-certificate" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Certificate Builder
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::is('admin.site-settings.index') || Route::is('admin.site-settings.commission-settings.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.site-settings.index') || Route::is('admin.site-settings.commission-settings.index') ? 'active' : '' }}"
                        href="{{ route('admin.site-settings.index') }}"
                        style="background-color: {{ Route::is('admin.site-settings.index') || Route::is('admin.site-settings.commission-settings.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.site-settings.index') || Route::is('admin.site-settings.commission-settings.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-settings" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Site Settings
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.database_clear.index') ? 'active' : '' }}">
                    <a class="nav-link {{ Route::is('admin.database_clear.index') ? 'active' : '' }}"
                        href="{{ route('admin.database_clear.index') }}"
                        style="background-color: {{ Route::is('admin.database_clear.index') ? '#18212e' : '' }};">
                        <span
                            class="nav-link-icon {{ Route::is('admin.database_clear.index') ? 'text-white' : '' }} d-md-none d-lg-inline-block">
                            <i class="ti ti-skull" style="font-size: 20px;"></i>
                        </span>
                        <span class="nav-link-title mt-1">
                            Database Clear
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
