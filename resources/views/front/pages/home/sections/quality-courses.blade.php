<section class="wsus__quality_courses mt_120 xs_mt_100">
    <div class="row quality_course_slider">
        <div class="quality_course_slider_item" style="background: url(/front/images/quality_courses_bg.jpg);">
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
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ $course?->thumbnail }}" alt="Courses" class="img-fluid">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/front/js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-tilt]').tilt({
            maxTilt: 20,
            perspective: 1000, // Transform perspective, the lower the more extreme the tilt gets.
            easing: "cubic-bezier(.03,.98,.52,.99)", // Easing on enter/exit.
            scale: 1, // 2 = 200%, 1.5 = 150%, etc..
            speed: 300, // Speed of the enter/exit transition.
            transition: true, // Set a transition on enter/exit.
            disableAxis: null, // What axis should be disabled. Can be X or Y.
            reset: true, // If the tilt effect has to be reset on exit.
            glare: false, // Enables glare effect
            maxGlare: 1 // From 0 - 1.
        });
    });

    const notyf = new Notyf({
        duration: 5000,
        dismissible: true,
        position: {
            x: 'right',
            y: 'bottom',
        },
    });

    function add_to_cart(course_id) {
        $.ajax({
            method: 'POST',
            url: base_url + `/cart/${course_id}/store`,
            data: {
                _token: csrf_token,

            },
            beforeSend: function() {
                $(`#add_to_cart_btn_${course_id}`).html('<i class="fas fa-spinner fa-spin"></i>Adding...');
            },
            success: function(data) {
                notyf.success(data.message);
                $(`#add_to_cart_btn_${course_id}`).html('Add to cart');
            },
            error: function(xhr, status, error) {
                let errors = xhr.responseJSON;
                $.each(errors, function(key, value) {
                    notyf.error(value);
                });
                $(`#add_to_cart_btn_${course_id}`).html('Add to cart');
            },
        })
    }

    $(function() {
        $('.add_to_cart_btn').on('click', function(e) {
            e.preventDefault();
            let course_id = $(this).data('course-id');
            add_to_cart(course_id)
        });
    });
</script>
