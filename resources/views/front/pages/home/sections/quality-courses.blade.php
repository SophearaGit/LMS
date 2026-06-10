@php
    $cart = \App\Models\Cart::where('user_id', auth()->id())->get();
    $enrolledCourseIds = \App\Models\Enrollments::where('user_id', auth()->id())
        ->pluck('course_id')
        ->toArray();
@endphp
<section class="wsus__quality_courses mt_120 xs_mt_100">
    <div class="row quality_course_slider">
        <div class="quality_course_slider_item"
            style="background: url({{ asset('/front/images/quality_courses_bg.jpg') }});">
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                        <div class="wsus__quality_courses_text">
                            <div class="wsus__section_heading heading_left mb_30">
                                <h5>100% QUALITY COURSES</h5>
                                <h2>{{ $featuredInstructorItems?->title }}</h2>
                            </div>
                            <p>{!! $featuredInstructorItems->subtitle !!}</p>
                            <a class="common_btn"
                                href="{{ $featuredInstructorItems?->button_url }}">{{ $featuredInstructorItems?->button_text }}
                                <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                        <div class="wsus__quality_courses_img">
                            <img src="{{ asset($featuredInstructorItems?->instructor_image) }}" alt="Quality Courses"
                                class="img-fluid w-100">
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                        <div class="row quality_course_card_slider">
                            @foreach ($featuredInstructorCourses as $course)
                                <div class="col-12" data-tilt>
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    @auth
                                                        <a href="javascript:void(0);" class="wishlist_btn"
                                                            data-course-id="{{ $course->id }}"
                                                            title="{{ in_array($course->id, $wishlistedCourseIds) ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                                            <img src="{{ asset('/front/images/love_icon_black.png') }}"
                                                                alt="Wishlist"
                                                                class="img-fluid wishlist-icon {{ in_array($course->id, $wishlistedCourseIds) ? 'wishlisted' : '' }}"
                                                                style="{{ in_array($course->id, $wishlistedCourseIds) ? 'filter: invert(27%) sepia(95%) saturate(7481%) hue-rotate(356deg) brightness(97%) contrast(118%);' : '' }}">
                                                        </a>
                                                    @else
                                                        <a href="{{ route('login') }}" title="Login to Wishlist">
                                                            <img src="{{ asset('/front/images/love_icon_black.png') }}"
                                                                alt="Wishlist" class="img-fluid">
                                                        </a>
                                                    @endauth
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i>
                                                {{ minToHours($course->duration) }}</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= round($course->reviews()->avg('rating')))
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                    <span>({{ number_format($course->reviews()->avg('rating') ?? 0, 1) }}
                                                        Rating)</span>
                                                </p>
                                            </div>
                                            <a class="title" href="{{ route('courses.show', $course->slug) }}">
                                                {{ Str::limit($course->title, 20, '...') }}
                                            </a>
                                            <ul>
                                                <li>{{ $course->lessons->count() }} Lessons</li>
                                                <li>{{ $course->enrollments()->count() }} Student</li>
                                            </ul>
                                            <a class="author"
                                                href="{{ route('courses.show', $course->slug) }}#instructor-tab">
                                                <div class="img">
                                                    <img src="{{ $course->instructor->image == '/default-images/avatar/teacher.png' ? asset('/default-images/avatar/both.jpg') : asset($course->instructor->image) }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>{{ $course->instructor->name }}</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn btn-primary"
                                                href="{{ route('courses.show', $course->slug) }}">
                                                Details<i class="fas fa-eye"></i>
                                            </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
