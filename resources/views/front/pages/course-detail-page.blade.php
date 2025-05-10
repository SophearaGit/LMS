@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('meta')
    <meta property="og:title" content="{{ $course->title }}" />
    <meta property="og:description" content="{{ $course->seo_description }}" />
    <meta property="og:image" content="{{ $course->thumbnail }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="Course" />
@endpush
@section('content')
    {{-- @include('front.pages.partials.bread-crumb') --}}
    <section class="wsus__breadcrumb course_details_breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <p class="rating">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <span>(4 Reviews)</span>
                            </p>
                            <h1>{{ $course->title }}</h1>
                            <ul class="list">
                                <li>
                                    <span><img src="{{ $course->instructor->image }}" alt="user"
                                            class="img-fluid"></span>
                                    By {{ $course->instructor->name }}
                                </li>
                                <li>
                                    <span><i class="{{ $course->category->icon }} text-white"></i></span>
                                    {{ $course->category->name }}
                                </li>
                                <li>
                                    <span><img src="/front/images/calendar_blue.png" alt="Calendar"
                                            class="img-fluid"></span>
                                    Last updated {{ date('d/M/Y', strtotime($course->updated_at)) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__courses_details pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__courses_details_area mt_40">

                        <ul class="nav nav-pills mb_40" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false" tabindex="-1">Curriculum</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false" tabindex="-1">Instructor</button>
                            </li>
                            <li class="nav-item d-none" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled" type="button" role="tab"
                                    aria-controls="pills-disabled" aria-selected="false" tabindex="-1">FAQs</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled2" type="button" role="tab"
                                    aria-controls="pills-disabled2" aria-selected="false" tabindex="-1">Review</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="wsus__courses_overview box_area">
                                    <h3>Course Description</h3><br>
                                    {!! $course->description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="wsus__courses_curriculum box_area">
                                    <h3>Course Curriculum</h3>
                                    <div class="accordion" id="accordionExample">
                                        @forelse ($course->chapters as $chapter)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $chapter->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-{{ $chapter->id }}">
                                                        {{ $chapter->title }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $chapter->id }}"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            @forelse ($chapter->lessons as $lesson)
                                                                <li
                                                                    class="{{ $lesson->is_preview == 1 ? 'active' : '' }}">
                                                                    <a href="">{{ $lesson->title }}</a>
                                                                    @if ($lesson->is_preview == 1)
                                                                        <a class=" venobox vbox-item" data-autoplay="true"
                                                                            data-vbtype="video"
                                                                            href="{{ $lesson->file_path }}">
                                                                            <span class="right_text">
                                                                                Preview
                                                                            </span>
                                                                        </a>
                                                                    @else
                                                                        <span class="right_text">
                                                                            {{ minToHours($lesson->duration) }}
                                                                        </span>
                                                                    @endif
                                                                </li>
                                                            @empty
                                                                <li>
                                                                    <span class="text-danger">
                                                                        No Lesson Found
                                                                    </span>
                                                                </li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="wsus__courses_instructor box_area">
                                    <h3>Instructor Details</h3>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="wsus__courses_instructor_img">
                                                <img src="{{ $course->instructor->image }}" alt="Instructor"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="wsus__courses_instructor_text">
                                                <h4>{{ $course->instructor->name }}</h4>
                                                <p class="designation">{{ $course->instructor->headline }}</p>
                                                <ul class="list">
                                                    <li><i class="fas fa-star" aria-hidden="true"></i> <b>74,537
                                                            Reviews</b></li>
                                                    <li><strong>4.7 Rating</strong></li>
                                                    <li>
                                                        <span><img src="/front/images/book_icon.png" alt="book"
                                                                class="img-fluid"></span>
                                                        {{ $course->instructor->courses()->count() }} Courses
                                                    </li>
                                                    <li>
                                                        <span><img src="/front/images/user_icon_gray.png" alt="user"
                                                                class="img-fluid"></span>
                                                        32 Students
                                                    </li>
                                                </ul>
                                                <ul class="badge d-flex flex-wrap">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Exclusive Author">
                                                        <img src="/front/images/badge_1.png" alt="Badge"
                                                            class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Top Earning"><img src="/front/images/badge_2.png"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Trending"><img src="/front/images/badge_3.png"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="2 Years of Membership"><img
                                                            src="/front/images/badge_4.png" alt="Badge"
                                                            class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Collector Lavel 1">
                                                        <img src="/front/images/badge_5.png" alt="Badge"
                                                            class="img-fluid">
                                                    </li>
                                                </ul>
                                                <p class="description">
                                                    {{ $course->instructor->bio }}
                                                </p>
                                                <ul class="link d-flex flex-wrap">
                                                    @if ($course->instructor->website != null)
                                                        <li><a href="{{ $course->instructor->website }}"><i
                                                                    class="fas fa-link" aria-hidden="true"></i></a></li>
                                                    @endif
                                                    @if ($course->instructor->x != null)
                                                        <li><a href="{{ $course->instructor->x }}"><i
                                                                    class="fab fa-twitter" aria-hidden="true"></i></a>
                                                        </li>
                                                    @endif
                                                    @if ($course->instructor->facebook != null)
                                                        <li><a href="{{ $course->instructor->facebook }}"><i
                                                                    class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                                        </li>
                                                    @endif
                                                    @if ($course->instructor->linkedin != null)
                                                        <li><a href="{{ $course->instructor->linkedin }}"><i
                                                                    class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                                                        </li>
                                                    @endif
                                                    @if ($course->instructor->github != null)
                                                        <li><a href="{{ $course->instructor->github }}"><i
                                                                    class="fab fa-github" aria-hidden="true"></i></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade d-none" id="pills-disabled" role="tabpanel"
                                aria-labelledby="pills-disabled-tab" tabindex="0">
                                <div class="wsus__course_faq box_area">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                    aria-controls="flush-collapseOne">
                                                    How long it take to create a video course?
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec
                                                    pharetra rutrum
                                                    ullamcorpe Ut eget convallis mi. Sed cursus aliquam eitu Nula sed
                                                    allium lectus
                                                    fermentum enim Nam maximus pretium consectetu lacinia finibus ipsum,
                                                    eget
                                                    fermentum nulla Pellentesque id facilisis magna dictum.
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-disabled2" role="tabpanel"
                                aria-labelledby="pills-disabled-tab2" tabindex="0">
                                <div class="wsus__courses_review box_area">
                                    <h3>Customer Reviews</h3>
                                    <div class="row align-items-center mb_50">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="total_review">
                                                <h2>4.7</h2>
                                                <p>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </p>
                                                <h4>3 Ratings</h4>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-6">
                                            <div class="review_bar">
                                                <div class="review_bar_single">
                                                    <p>5 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar1" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">85%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="85"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">87</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>4 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar2" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">70%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="70"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">69</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>3 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar3" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">50%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="50"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">44</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>2 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar4" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">30%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="30"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">29</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>1 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar5" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">10%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="10"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">12</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <h3>Reviews</h3>
                                    <div class="wsus__course_single_reviews">
                                        <div class="wsus__single_review_img">
                                            <img src="/front/images/testimonial_user_1.png" alt="user"
                                                class="img-fluid">
                                        </div>
                                        <div class="wsus__single_review_text">
                                            <h4>Dominic L. Ement</h4>
                                            <h6> March 23,2024 at 8:37 pm
                                                <span>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </span>
                                            </h6>
                                            <p>Donec vel mauris at lectus iaculis elementum vel vel
                                                lacus. Sed finibus velit vitae risus imperdiet placerat. Ut posuere eros
                                                ut molestie rhoncus. Duis eget ex elementum, ultricies dolor sed,
                                                hendrerit diam. Donec ut blandit nunc, et tempus lorem.</p>
                                        </div>
                                    </div>
                                    <div class="wsus__course_single_reviews">
                                        <div class="wsus__single_review_img">
                                            <img src="/front/images/testimonial_user_2.png" alt="user"
                                                class="img-fluid">
                                        </div>
                                        <div class="wsus__single_review_text">
                                            <h4>Smith jhon</h4>
                                            <h6> March 23,2024 at 8:37 pm
                                                <span>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </span>
                                            </h6>
                                            <p>Donec vel mauris at lectus iaculis elementum vel vel
                                                lacus. Sed finibus velit vitae risus imperdiet placerat. Ut posuere eros
                                                ut molestie rhoncus. Duis eget ex elementum, ultricies dolor sed,
                                                hendrerit diam. Donec ut blandit nunc, et tempus lorem.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__courses_review_input box_area mt_40">
                                    <h3>Write a Review</h3>
                                    <p class="short_text">Your email address will not be published. Required fields are
                                        marked *</p>
                                    <div class="select_rating d-flex flex-wrap">Your Rating:
                                        <ul id="starRating" data-stars="5" class="starrating-init">
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                    </div>
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <input type="text" placeholder="Name">
                                            </div>
                                            <div class="col-xl-6">
                                                <input type="email" placeholder="Email">
                                            </div>
                                            <div class="col-xl-12">
                                                <textarea rows="7" placeholder="Comments"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Save my name, email, and website in this browser for the next
                                                        time I comment.
                                                    </label>
                                                </div>
                                                <a href="#" class="common_btn">Post Comment</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__courses_sidebar">
                        <div class="wsus__courses_sidebar_video">
                            <img src="{{ $course->thumbnail }}" alt="Video" class="img-fluid">
                            @if ($course->demo_video_source != null)
                                <a class="play_btn venobox vbox-item" data-autoplay="true" data-vbtype="video"
                                    href="{{ $course->demo_video_source }}">
                                    <img src="/front/images/play_icon_white.png" alt="Play" class="img-fluid">
                                </a>
                            @endif
                        </div>
                        <h3 class="wsus__courses_sidebar_price">
                            @if ($course->price == 0)
                                Free
                            @else
                                @if ($course->discount > 0)
                                    <del>${{ number_format($course->price, 2) }}</del>
                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                @else
                                    ${{ number_format($course->price, 2) }}
                                @endif
                            @endif
                        </h3>
                        <div class="wsus__courses_sidebar_list_info">
                            <ul>
                                <li>
                                    <p>
                                        <span><img src="/front/images/clock_icon_black.png" alt="clock"
                                                class="img-fluid"></span>
                                        Course Duration
                                    </p>
                                    {{ minToHours($course->duration) }}
                                </li>
                                <li>
                                    <p>
                                        <span><img src="/front/images/network_icon_black.png" alt="network"
                                                class="img-fluid"></span>
                                        Skill Level
                                    </p>
                                    {{ $course->level->name }}
                                </li>
                                <li>
                                    <p>
                                        <span><img src="/front/images/user_icon_black_2.png" alt="User"
                                                class="img-fluid"></span>
                                        Student Enrolled
                                    </p>
                                    47
                                </li>
                                <li>
                                    <p>
                                        <span><img src="/front/images/language_icon_black.png" alt="Language"
                                                class="img-fluid"></span>
                                        Language
                                    </p>
                                    {{ $course->language->name }}
                                </li>
                            </ul>
                            <a class="common_btn" href="#">Enroll The Course <i class="far fa-arrow-right"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="wsus__courses_sidebar_share_btn d-flex flex-wrap justify-content-between">
                            <a href="#" class="common_btn"><i class="far fa-heart" aria-hidden="true"></i> Add to
                                Wishlist</a>
                        </div>
                        <div class="wsus__courses_sidebar_share_area">
                            <span>Share:</span>
                            <ul>
                                <li class="ez-facebook"><a href=""><i class="fab fa-facebook-f"
                                            aria-hidden="true"></i></a></li>
                                <li class="ez-linkedin"><a href=""><i class="fab fa-linkedin-in"
                                            aria-hidden="true"></i></a></li>
                                <li class="ez-x"><a href="#"><i class="fab fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li class="ez-reddit"><a href="#"><i class="fab fa-reddit"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="wsus__courses_sidebar_info">
                            <h3>This Course Includes</h3>
                            <ul>
                                <li>
                                    <span><img src="/front/images/video_icon_black.png" alt="video"
                                            class="img-fluid"></span>
                                    {{-- 54 min 24 sec Video Lectures --}}
                                    {{ minToHours($course->duration) }} Video Lectures
                                </li>
                                @if ($course->certificate == 1)
                                    <li>
                                        <span><img src="/front/images/certificate_icon_black.png" alt="Certificate"
                                                class="img-fluid"></span>
                                        Certificate of Completion
                                    </li>
                                @endif
                                <li>
                                    <span><img src="/front/images/life_time_icon.png" alt="Certificate"
                                            class="img-fluid"></span>
                                    Course Lifetime Access
                                </li>
                            </ul>

                        </div>
                        <div class="wsus__courses_sidebar_instructor">
                            <div class="image_area d-flex flex-wrap align-items-center">
                                <div class="img">
                                    <img src="{{ $course->instructor->image }}" alt="Instructor" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h3>{{ $course->instructor->name }}</h3>
                                    <p><span>{{ $course->instructor->role }}</span> Level 2</p>
                                </div>
                            </div>
                            <ul class="d-flex flex-wrap">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Exclusive Author">
                                    <img src="/front/images/badge_1.png" alt="Badge" class="img-fluid">
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Top Earning"><img
                                        src="/front/images/badge_2.png" alt="Badge" class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Trending"><img
                                        src="/front/images/badge_3.png" alt="Badge" class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="2 Years of Membership"><img src="/front/images/badge_4.png"
                                        alt="Badge" class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Collector Lavel 1">
                                    <img src="/front/images/badge_5.png" alt="Badge" class="img-fluid">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
