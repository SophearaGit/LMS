@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft"
                    style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__sidebar">
                        <form action="{{ route('courses') }}">
                            <div class="wsus__sidebar_search">
                                <input type="text" placeholder="Search Course" name="search"
                                    value="{{ request()->search ?? '' }}">
                                <button type="submit">
                                    <img src="/front/images/search_icon.png" alt="Search" class="img-fluid">
                                </button>
                            </div>

                            <div class="wsus__sidebar_category">
                                <h3>Categories</h3>
                                <ul class="categoty_list">
                                    @foreach ($categories as $category)
                                        @if ($category->subCategories->count() > 0)
                                            <li data-id="li-{{ $category->id }}"
                                                class="{{ collect($category->subCategories)->pluck('id')->intersect(request()->category ?? collect())->isNotEmpty()
                                                    ? 'active'
                                                    : '' }}">
                                                {{ $category->name }}
                                                <div class="wsus__sidebar_sub_category">
                                                    @foreach ($category->subCategories as $subCategory)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $subCategory->id }}"
                                                                id="sub-cat-{{ $subCategory->id }}" name="category[]"
                                                                @checked(in_array($subCategory->id, request()->category ?? []))>
                                                            <label class="form-check-label"
                                                                for="sub-cat-{{ $subCategory->id }}">
                                                                {{ $subCategory->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="wsus__sidebar_course_lavel">
                                <h3>Difficulty Level</h3>
                                @foreach ($levels as $level)
                                    @if ($level->courses->count() > 0)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $level->id }}"
                                                name="level[]" id="level-{{ $level->id }}" @checked(in_array($level->id, request()->level ?? []))>
                                            <label class="form-check-label" for="level-{{ $level->id }}">
                                                {{ $level->name }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- <div class="wsus__sidebar_course_lavel rating">
                                <h3>Rating</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr1">
                                    <label class="form-check-label" for="flexCheckDefaultr1">
                                        <i class="fas fa-star" aria-hidden="true"></i> 5 star
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr2">
                                    <label class="form-check-label" for="flexCheckDefaultr2">
                                        <i class="fas fa-star" aria-hidden="true"></i> 4 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr3">
                                    <label class="form-check-label" for="flexCheckDefaultr3">
                                        <i class="fas fa-star" aria-hidden="true"></i> 3 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr4">
                                    <label class="form-check-label" for="flexCheckDefaultr4">
                                        <i class="fas fa-star" aria-hidden="true"></i> 2 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr5">
                                    <label class="form-check-label" for="flexCheckDefaultr5">
                                        <i class="fas fa-star" aria-hidden="true"></i> 1 star or above
                                    </label>
                                </div>
                            </div> --}}

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Language</h3>
                                @foreach ($languages as $language)
                                    @if ($language->courses->count() > 0)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $language->id }}"
                                                id="language-{{ $language->id }}" name="language[]"
                                                @checked(in_array($language->id, request()->language ?? []))>
                                            <label class="form-check-label" for="language-{{ $language->id }}">
                                                {{ $language->name }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="wsus__sidebar_rating">
                                <h3>Price Range</h3>
                                <div class="range_slider">
                                    <input class="al-range-slider__input js-al-range-slider__input" name="from"
                                        type="text"><input class="al-range-slider__input js-al-range-slider__input"
                                        name="to" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <button type="submit" class="common_btn">Search</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-lg-1">
                    <div class="wsus__page_courses_header wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <p>Showing <span>1-{{ $courses->count() }}</span> Of <span>{{ $courses->total() }}</span> Results
                        </p>
                        <form action="{{ route('courses') }}">
                            <p>Sort-by:</p>
                            <select class="select_js order_by" style="display: none;" name="order_by"
                                onchange="this.form.submit()">
                                <option value="desc"@selected(request()->order_by == 'desc')>New to Old</option>
                                <option value="asc" @selected(request()->order_by == 'asc')>Old to New</option>
                            </select>
                        </form>
                    </div>
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-xl-4 col-md-6 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;" data-tilt>
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
                                        <span class="time"><i class="far fa-clock" aria-hidden="true"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>
                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
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
                                        <a id="add_to_cart_btn_{{ $course->id }}" class="common_btn add_to_cart_btn"
                                            data-course-id="{{ $course->id }}" href="#">Add to cart<i
                                                class="far fa-arrow-right" aria-hidden="true"></i></a>
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
                        @empty
                        @endforelse

                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: hidden; animation-name: none;">
                        <nav aria-label="Page navigation example">
                            {{ $courses->withQueryString()->links('vendor.pagination.front.custom') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.categoty_list li.active .wsus__sidebar_sub_category').each(function() {
                var dynamicHeight = 0;
                $(this).find('div').each(function() {
                    dynamicHeight += $(this).outerHeight(true);
                });
                $(this).css("height", dynamicHeight + "px");
            });
        });

        // Variables.
        const base_url = $(`meta[name="base_url"]`).attr('content');
        const notyf = new Notyf({
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom',
            },
        });

        // Reuseable functions.
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

        // On DOM load.
        $(function() {
            $('.add_to_cart_btn').on('click', function(e) {
                e.preventDefault();
                let course_id = $(this).data('course-id');
                add_to_cart(course_id)
            });
        });
    </script>
@endpush
