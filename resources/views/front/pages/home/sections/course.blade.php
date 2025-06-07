@php
    $categoryOne = \App\Models\CourseCategory::where('id', $latestCourses->category_one)->first();
    $categoryTwo = \App\Models\CourseCategory::where('id', $latestCourses->category_two)->first();
    $categoryThree = \App\Models\CourseCategory::where('id', $latestCourses->category_three)->first();
    $categoryFour = \App\Models\CourseCategory::where('id', $latestCourses->category_four)->first();
    $categoryFive = \App\Models\CourseCategory::where('id', $latestCourses->category_five)->first();
@endphp

<section class="wsus__courses_3 pt_120 xs_pt_100 mt_120 xs_mt_90 pb_120 xs_pb_100">
    <div class="container">

        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp">
                <div class="wsus__section_heading mb_45">
                    <h5>Featured Courses</h5>
                    <h2>Latest Bundle Courses.</h2>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp">
            <div class="col-xxl-6 col-xl-8 m-auto">
                <div class="wsus__filter_area mb_15">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        @if ($categoryOne)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-capitalize active" id="pills-{{ $categoryOne->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryOne->id }}" type="button"
                                    role="tab" aria-controls="pills-{{ $categoryOne->id }}" aria-selected="true">
                                    {{ $categoryOne->name }}
                                </button>
                            </li>
                        @endif
                        @if ($categoryTwo)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-capitalize " id="pills-{{ $categoryTwo->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryTwo->id }}" type="button"
                                    role="tab" aria-controls="pills-{{ $categoryTwo->id }}" aria-selected="false">
                                    {{ $categoryTwo->name }}
                                </button>
                            </li>
                        @endif
                        @if ($categoryThree)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-capitalize " id="pills-{{ $categoryThree->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryThree->id }}"
                                    type="button" role="tab" aria-controls="pills-{{ $categoryThree->id }}"
                                    aria-selected="false">
                                    {{ $categoryThree->name }}
                                </button>
                            </li>
                        @endif
                        @if ($categoryFour)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-capitalize " id="pills-{{ $categoryFour->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryFour->id }}"
                                    type="button" role="tab" aria-controls="pills-{{ $categoryFour->id }}"
                                    aria-selected="false">
                                    {{ $categoryFour->name }}
                                </button>
                            </li>
                        @endif
                        @if ($categoryFive)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-capitalize " id="pills-{{ $categoryFive->id }}-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryFive->id }}"
                                    type="button" role="tab" aria-controls="pills-{{ $categoryFive->id }}"
                                    aria-selected="false">
                                    {{ $categoryFive->name }}
                                </button>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            @if ($categoryOne)
                <div class="tab-pane fade show active" id="pills-{{ $categoryOne->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $categoryOne->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($categoryOne->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}"
                                            class="common_btn add_to_cart_btn" data-course-id="{{ $course->id }}"
                                            href="#">Add to cart<i class="far fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="{{ route('courses') }}">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($categoryTwo)
                <div class="tab-pane fade" id="pills-{{ $categoryTwo->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $categoryTwo->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($categoryTwo->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}"
                                            class="common_btn add_to_cart_btn" data-course-id="{{ $course->id }}"
                                            href="#">Add to cart<i class="far fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="{{ route('courses') }}">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($categoryThree)
                <div class="tab-pane fade" id="pills-{{ $categoryThree->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $categoryThree->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($categoryThree->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}"
                                            class="common_btn add_to_cart_btn" data-course-id="{{ $course->id }}"
                                            href="#">Add to cart<i class="far fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="{{ route('courses') }}">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($categoryFour)
                <div class="tab-pane fade" id="pills-{{ $categoryFour->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $categoryFour->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($categoryFour->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}"
                                            class="common_btn add_to_cart_btn" data-course-id="{{ $course->id }}"
                                            href="#">Add to cart<i class="far fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="{{ route('courses') }}">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($categoryFive)
                <div class="tab-pane fade" id="pills-{{ $categoryFive->id }}" role="tabpanel"
                    aria-labelledby="pills-{{ $categoryFive->id }}-tab" tabindex="0">
                    <div class="row">
                        @foreach ($categoryFive->courses()->latest()->take(8)->get() as $course)
                            <div class="col-xl-3 col-md-6 col-lg-4">
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>

                                        <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                            {{ $course->title }}
                                        </a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}"
                                            class="common_btn add_to_cart_btn" data-course-id="{{ $course->id }}"
                                            href="#">Add to cart<i class="far fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="{{ route('courses') }}">Browse More Courses <i
                                    class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
