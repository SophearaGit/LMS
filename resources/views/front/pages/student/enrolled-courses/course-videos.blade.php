<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="base_url" content="{{ url('/') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>EduCore - Online Courses & Education HTML Template</title>
    <link rel="icon" type="image/png" href="/front/images/favicon.png">
    <link rel="stylesheet" href="/front/css/all.min.css">
    <link rel="stylesheet" href="/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/css/animated_barfiller.css">
    <link rel="stylesheet" href="/front/css/slick.css">
    <link rel="stylesheet" href="/front/css/venobox.min.css">
    <link rel="stylesheet" href="/front/css/scroll_button.css">
    <link rel="stylesheet" href="/front/css/nice-select.css">
    <link rel="stylesheet" href="/front/css/pointer.css">
    <link rel="stylesheet" href="/front/css/jquery.calendar.css">
    <link rel="stylesheet" href="/front/css/range_slider.css">
    <link rel="stylesheet" href="/front/css/startRating.css">
    <link rel="stylesheet" href="/front/css/video_player.css">
    <link rel="stylesheet" href="/front/css/jquery.simple-bar-graph.min.css">
    <link rel="stylesheet" href="/front/css/select2.min.css">
    <link rel="stylesheet" href="/front/css/sticky_menu.css">
    <link rel="stylesheet" href="/front/css/animate.css">
    <link rel=" stylesheet" href="/front/css/spacing.css">
    <link rel="stylesheet" href="/front/css/style.css">
    <link rel="stylesheet" href="/front/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body class="home_3">


    <!--============ PRELOADER START ===========-->
    <div id="preloader">
        <div class="preloader_icon">
            <img src="/front/images/preloader.png" alt="Preloader" class="img-fluid">
        </div>
    </div>
    <!--============ PRELOADER START ===========-->


    <!--===========================
        COURSE VIDEO START
    ============================-->
    <section class="wsus__course_video">
        <div class="col-12">
            <div class="wsus__course_header">
                <a href="{{ route('student.enroll_courses.index') }}"><i class="fas fa-angle-left"></i>
                    {{ $course->title }}</a>
                <p>Your Progress: {{ $lessonCount }} of {{ $finishCount }}
                    ({{ round(($finishCount / $lessonCount) * 100) }}%)
                </p>
            </div>
        </div>

        <div class="wsus__course_video_player">

            <!-- <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                poster="/front/images/video_thumb.jpg" data-setup="{}">
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/webm" />
            </video> -->

            {{-- <video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": ""}] }'>
            </video> --}}


            <div class="video_holder">

            </div>

            <div class="video_tabs_area">
                <ul class="nav nav-pills" id="pills-tab2" role="tablist">
                    <li class="nav-item d-lg-none" role="presentation">
                        <button class="nav-link" id="pills-home-tab2" data-bs-toggle="pill"
                            data-bs-target="#pills-home2" type="button" role="tab" aria-controls="pills-home2"
                            aria-selected="true">Course Content</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab"
                            aria-controls="pills-contact" aria-selected="false">Announcements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-disabled" type="button" role="tab"
                            aria-controls="pills-disabled" aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade d-lg-none" id="pills-home2" role="tabpanel"
                        aria-labelledby="pills-home-tab2" tabindex="0">
                        <div class="video_course_content">
                            <div class="wsus__course_sidebar">
                                <h2 class="video_heading">Course Content</h2>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne4409" aria-expanded="true"
                                                aria-controls="collapseOne4409">
                                                <b>Introduction</b>
                                                <span>5/5</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne4409" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        1_Setting up Environment (Part - 1)
                                                        <span>
                                                            <img src="/front/images/video_icon_black_2.png"
                                                                alt="video" class="img-fluid">
                                                            06.03
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        2_Environment Setup for Project (Part - 1)
                                                        <span>
                                                            <img src="/front/images/video_icon_black_2.png"
                                                                alt="video" class="img-fluid">
                                                            06.03
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary" type="button">
                                                        <i class="fas fa-folder-open"></i> Resources
                                                    </button>
                                                    <ul>
                                                        <li><a class="dropdown-item" href="#">Resources File
                                                                01</a></li>
                                                        <li><a class="dropdown-item" href="#">Resources 02</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Resources 03</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo2209"
                                                aria-expanded="false" aria-controls="collapseTwo2209">
                                                <b>Project Setup and Multi Auth Setup</b>
                                                <span>5/5</span>
                                            </button>
                                        </h2>
                                        <div id="collapseTwo2209" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        1_Setting up Environment (Part - 1)
                                                        <span>
                                                            <img src="/front/images/video_icon_black_2.png"
                                                                alt="video" class="img-fluid">
                                                            06.03
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        2_Environment Setup for Project (Part - 1)
                                                        <span>
                                                            <img src="/front/images/video_icon_black_2.png"
                                                                alt="video" class="img-fluid">
                                                            06.03
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary" type="button">
                                                        <i class="fas fa-folder-open"></i> Resources
                                                    </button>
                                                    <ul>
                                                        <li><a class="dropdown-item" href="#">Resources File
                                                                01</a></li>
                                                        <li><a class="dropdown-item" href="#">Resources 02</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Resources 03</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="video_about">
                            <h1 class="text-capitalize">About this lesson</h1>
                            <p class="short_description lesson_description"></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                        aria-labelledby="pills-contact-tab" tabindex="0">
                        <div class="video_announcement">
                            <h1>No announcements posted yet</h1>
                            <p>The instructor hasn’t added any announcements to this course yet. Announcements are used
                                to inform you of updates or additions to the course.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-disabled" role="tabpanel"
                        aria-labelledby="pills-disabled-tab" tabindex="0">
                        <div class="video_review">
                            <h2>Reviews (09)</h2>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="/front/images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="/front/images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>
                            <div class="course-review-head">
                                <div class="review-author-thumb">
                                    <img src="/front/images/review-author.png" alt="img">
                                </div>
                                <div class="review-author-content">
                                    <div class="author-name">
                                        <h5 class="name">Jura Hujaor <span>2 Days ago</span></h5>
                                        <div class="author-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h4 class="title">The best LMS Design System</h4>
                                    <p>Maximus ligula eleifend id nisl quis interdum. Sed malesuada tortor non turpis
                                        semper bibendum nisi porta, malesuada risus nonerviverra dolor. Vestibulum ante
                                        ipsum primis in faucibus.</p>
                                </div>
                            </div>


                            <div class="video_review_imput">
                                <h2>Write a reviews</h2>
                                <p>
                                    <span>select rating:</span>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </p>
                                <form action="#">
                                    <textarea name="" id="" cols="30" rows="5" placeholder="Youe coment..."></textarea>
                                    <button type="submit" class="btn arrow-btn back_qna_list">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="wsus__course_sidebar d-none d-lg-block">
            <h2 class="video_heading">Course Content</h2>
            <div class="accordion" id="accordionExample">
                @forelse ($course->chapters as $chapter)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="false"
                                aria-controls="collapse-{{ $chapter->id }}">
                                <b>{{ $chapter->title }}</b>
                                <span>0/{{ count($chapter->lessons) }}</span>
                            </button>
                        </h2>
                        <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach ($chapter->lessons as $lesson)
                                    <div>
                                        {{-- LESSON CHECKBOX --}}
                                        <div class="form-check ">
                                            {{-- LESSON CHECKBOX --}}
                                            <input class="form-check-input make_completed"
                                                data-id-course="{{ $course->id }}"
                                                data-id-chapter="{{ $chapter->id }}"
                                                data-id-lesson="{{ $lesson->id }}" type="checkbox" value=""
                                                {{ $lesson->history?->is_completed == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label lesson"
                                                data-id-course="{{ $course->id }}"
                                                data-id-chapter="{{ $chapter->id }}"
                                                data-id-lesson="{{ $lesson->id }}">
                                                {{-- LESSON TITLE --}}
                                                {{ $lesson->title }}
                                                <span>
                                                    <img src="/front/images/video_icon_black_2.png" alt="video"
                                                        class="img-fluid">
                                                    {{ minToHours($lesson->duration) }}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- LESSON RESOURCES DROPDOWN --}}
                                {{-- <div class="dropdown">
                                    <button class="btn btn-secondary" type="button">
                                        <i class="fas fa-folder-open"></i> Resources
                                    </button>
                                    <ul>
                                        <li><a class="dropdown-item" href="#">Resources File 01</a></li>
                                        <li><a class="dropdown-item" href="#">Resources 02</a></li>
                                        <li><a class="dropdown-item" href="#">Resources 03</a></li>
                                    </ul>
                                </div> --}}
                                {{-- FORM CHECK WITH A RESOURCES DROPDOWN --}}
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
                {{-- <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <b>Project Setup and Multi Auth Setup</b>
                            <span>5/5</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    1_Setting up Environment (Part - 1)
                                    <span>
                                        <img src="/front/images/video_icon_black_2.png" alt="video"
                                            class="img-fluid">
                                        06.03
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    2_Environment Setup for Project (Part - 1)
                                    <span>
                                        <img src="/front/images/video_icon_black_2.png" alt="video"
                                            class="img-fluid">
                                        06.03
                                    </span>
                                </label>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fas fa-folder-open"></i> Resources
                                </button>
                                <ul>
                                    <li><a class="dropdown-item" href="#">Resources File 01</a></li>
                                    <li><a class="dropdown-item" href="#">Resources 02</a></li>
                                    <li><a class="dropdown-item" href="#">Resources 03</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!--===========================
        COURSE VIDEO END
    ============================-->
    <!--jquery library js-->
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script src="/front/extra/player.js"></script>
    <!--bootstrap js-->
    <script src="/front/js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="/front/js/Font-Awesome.js"></script>
    <!--marquee js-->
    <script src="/front/js/jquery.marquee.min.js"></script>
    <!--slick js-->
    <script src="/front/js/slick.min.js"></script>
    <!--countup js-->
    <script src="/front/js/jquery.waypoints.min.js"></script>
    <script src="/front/js/jquery.countup.min.js"></script>
    <!--venobox js-->
    <script src="/front/js/venobox.min.js"></script>
    <!--nice-select js-->
    <script src="/front/js/jquery.nice-select.min.js"></script>
    <!--Scroll Button js-->
    <script src="/front/js/scroll_button.js"></script>
    <!--pointer js-->
    <script src="/front/js/pointer.js"></script>
    <!--range slider js-->
    <script src="/front/js/range_slider.js"></script>
    <!--barfiller js-->
    <script src="/front/js/animated_barfiller.js"></script>
    <!--calendar js-->
    <script src="/front/js/jquery.calendar.js"></script>
    <!--starRating js-->
    <script src="/front/js/starRating.js"></script>
    <!--Bar Graph js-->
    <script src="/front/js/jquery.simple-bar-graph.min.js"></script>
    <!--select2 js-->
    <script src="/front/js/select2.min.js"></script>
    <!--Video player js-->
    <script src="/front/js/video_player.min.js"></script>
    <script src="/front/js/video_player_youtube.js"></script>
    <script src="/front/js/videojs-vimeo.cjs.js"></script>
    <script src="/front/js/videojs-vimeo.umd.js"></script>
    <!--wow js-->
    <script src="/front/js/wow.min.js"></script>

    <!--main/custom js-->
    <script src="/front/js/main.js"></script>

    {{-- notyf --}}
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    {{-- docx-preview --}}
    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="/front/js/docx-preview.min.js"></script>

    <script>
        $(function() {
            let lessons = $('.lesson');
            let isLessonCompleted = $('.make_completed');

            $.each(lessons, function(index, lesson) {
                let courseId = $(lesson).data('id-course');
                let chapterId = $(lesson).data('id-chapter');
                let lessonId = $(lesson).data('id-lesson');
                if (
                    courseId == {{ $lastWatchHistory?->course_id }} &&
                    chapterId == {{ $lastWatchHistory?->chapter_id }} &&
                    lessonId == {{ $lastWatchHistory?->lesson_id }}
                ) {
                    $(lesson).click();
                    $(lesson).closest('.accordion-collapse').addClass('show');
                    $(lesson).closest('.accordion-item')
                        .find('.accordion-button')
                        .removeClass('collapsed')
                        .attr('aria-expanded', 'true');

                    $(lesson).css('font-weight', 'bold');
                    $(lesson).css('text-transform', 'uppercase');
                    $(lesson).css('color', '#436ce8');
                }
            });
        })
    </script>

</body>

</html>
