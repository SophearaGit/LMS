@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')

    {{-- BANNER 3 START --}}
    @include('front.pages.home.sections.banner')
    {{-- BANNER 3 END --}}

    {{-- EXPLORE CATEGORIES START --}}
    @include('front.pages.home.sections.explore')
    {{-- EXPLORE CATEGORIES END --}}

    {{-- ABOUT 3 START --}}
    @include('front.pages.home.sections.about')
    {{-- ABOUT 3 END --}}


    {{-- COUESES 3 START --}}
    @include('front.pages.home.sections.course')
    {{-- COUESES 3 END --}}


    {{-- OFFER START --}}
    @include('front.pages.home.sections.offer')
    {{-- OFFER END --}}


    {{-- BECOME INSTRUCTOR START --}}
    @include('front.pages.home.sections.instructor')
    {{-- BECOME INSTRUCTOR END --}}


    {{-- VIDEO START --}}
    @include('front.pages.home.sections.video')
    {{-- VIDEO END --}}


    {{-- BRAND START --}}
    @include('front.pages.home.sections.brand')
    {{-- BRAND END --}}


    {{-- QUALITY COURSES START --}}
    @include('front.pages.home.sections.quality-courses')
    {{-- QUALITY COURSES END --}}


    {{-- TESTIMONIAL START --}}
    @include('front.pages.home.sections.testimonial')
    {{-- TESTIMONIAL END --}}


    {{-- BLOG 4 START --}}
    @include('front.pages.home.sections.blog')
    {{-- BLOG 4 END --}}

@endsection

@push('scripts')
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
            let addToCartBtn = $(`#add_to_cart_btn_${course_id}`);
            let loading = '<i class="fas fa-spinner fa-spin"></i>Adding...';
            let checked = 'In cart<i class="fas fa-check"></i>';
            let unchecked = 'Add to cart<i class="far fa-arrow-right" aria-hidden="true"></i>';
            $.ajax({
                method: 'POST',
                url: base_url + `/cart/${course_id}/store`,
                data: {
                    _token: csrf_token,
                },
                beforeSend: function() {
                    addToCartBtn.html(loading);
                },
                success: function(data) {
                    notyf.success(data.message);
                    addToCartBtn.html(checked);
                    $('#cart_count_badge').removeClass('d-none').text(data.cartCount);
                    $('#mobile_cart_count_badge').removeClass('d-none').text(data.cartCount);
                },
                error: function(xhr, status, error) {
                    let errors = xhr.responseJSON;
                    $.each(errors, function(key, value) {
                        notyf.error(value);
                    });
                    if (errors.message == 'Course already added to cart.') {
                        addToCartBtn.html(checked);
                    } else if (errors.message == 'Unauthenticated.') {
                        addToCartBtn.html(unchecked);
                    }
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
@endpush
