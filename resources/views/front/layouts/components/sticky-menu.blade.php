@php
    $categories = \App\Models\CourseCategory::with([
        'subCategories' => function ($query) {
            $query->where('status', 1)->whereHas('courses', function ($q) {
                $q->where('is_approved', 'approved')->where('status', 'active');
            });
        },
    ])
        ->whereNull('parent_id')
        ->where('show_at_trending', 1)
        ->where('status', 1)
        ->whereHas('subCategories', function ($query) {
            $query->where('status', 1)->whereHas('courses', function ($q) {
                $q->where('is_approved', 'approved')->where('status', 'active');
            });
        })
        ->latest()
        ->get();
    $customPages = \App\Models\CustomPage::where('status', 1)->where('show_at_nav', 1)->limit(2)->latest()->get();
@endphp
<div class="mobile_menu_area">
    <div class="mobile_menu_area_top">
        <a class="mobile_menu_logo" href="index.html">
            <img src="{{ asset('/front/images/logo.png') }}" alt="{{ config('settings.site_name') }}">
        </a>
        <div class="mobile_menu_icon d-block d-lg-none" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
            <span class="mobile_menu_icon"><i class="far fa-stream menu_icon_bar"></i></span>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fal fa-times"></i></button>
        <div class="offcanvas-body">
            <ul class="mobile_menu_header d-flex flex-wrap">
                <li>
                    <a href="{{ route('cart.index') }}"><i class="far fa-shopping-basket"></i>
                        <span id="mobile_cart_count_badge"
                            class=" {{ cartTotalCourseCount() > 0 ? '' : 'd-none' }}">{{ cartTotalCourseCount() }}</span>
                    </a>
                </li>
                @auth
                    @if (Auth::user()->role == 'student')
                        <li>
                            <a href="{{ route('student.dashboard') }}"><i class="far fa-user"></i></a>
                        </li>
                    @elseif (Auth::user()->role == 'instructor')
                        <li>
                            <a href="{{ route('instructor.dashboard') }}"><i class="far fa-user"></i></a>
                        </li>
                    @endif
                @else
                    <li>
                        <a href="{{ route('login') }}"><i class="far fa-user"></i></a>
                    </li>
                @endauth
            </ul>
            <form class="mobile_menu_search" action="{{ route('courses') }}">
                <input type="text" placeholder="Search" name="search">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
            <div class="mobile_menu_item_area">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">menu</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Categories</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <ul class="main_mobile_menu">
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('home.about') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('courses') }}">Courses</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}">Blogs</a>
                            </li>
                            <li>
                                <a href="{{ route('home.contact_us') }}">Contact Us</a>
                            </li>
                            @foreach ($customPages as $customPage)
                                <li>
                                    <a href="{{ route('custom_page', $customPage->slug) }}">
                                        {{ Str::limit($customPage->title, 20, '...') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <ul class="main_mobile_menu">
                            @foreach ($categories as $category)
                                <li class="mobile_dropdown">
                                    <a href="javascript:void(0);">
                                        <span>
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                                class="img-fluid">
                                        </span>
                                        {{ $category->name }}
                                    </a>
                                    @if ($category->subCategories->count() > 0)
                                        <ul class="inner_menu">
                                            @foreach ($category->subCategories as $subCategory)
                                                <li>
                                                    <a href="{{ route('courses', ['category' => $subCategory->id]) }}">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
