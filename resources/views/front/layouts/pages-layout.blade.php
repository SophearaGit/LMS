<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="base_url" content="{{ url('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
    @if (config('settings.site_favicon'))
        <link rel="icon" type="image/png" href="{{ asset(config('settings.site_favicon')) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('front/images/preloader.png') }}">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/scroll_button.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/pointer.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/range_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/startRating.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/video_player.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery.simple-bar-graph.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/sticky_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <title>@yield('pageTitle')</title>
    @stack('stylesheets')

    <!--jquery library js-->
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    {{-- jquery-ui --}}
    <script src="/front/js/jquery-ui.min.js"></script>
</head>
@auth
    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 500px;">
            <div class="modal-content"
                style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                {{-- Header --}}
                <div class="modal-header border-0 pb-0 px-4 pt-4"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div>
                        <h5 class="modal-title text-white fw-bold mb-1">
                            <i class="fas fa-heart me-2"></i>My Wishlist
                        </h5>
                        <p class="text-white mb-3" style="opacity: 0.8; font-size: 13px;" id="wishlist_modal_subtitle">
                            Loading...
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-close-white mb-auto" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- Body --}}
                <div class="modal-body px-4 py-3" id="wishlist_modal_body" style="max-height: 460px; overflow-y: auto;">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
                {{-- Footer --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <a href="{{ route('courses') }}" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Browse More</a>
                </div>
            </div>
        </div>
    </div>
@endauth

<body class="home_3">
    {{-- PRELOADER START --}}
    {{-- @include('front.layouts.components.preloader') --}}
    {{-- PRELOADER START --}}
    {{-- HEADER START --}}
    @include('front.layouts.components.header')
    {{-- HEADER END --}}
    {{-- MAIN MENU 3 START --}}
    @include('front.layouts.components.main-menu')
    {{-- MAIN MENU 3 END --}}
    {{-- STICKY MENU START --}}
    @include('front.layouts.components.sticky-menu')
    {{-- STICKY MENU END --}}
    {{-- CONTENT START --}}
    @yield('content')
    {{-- CONTENT END --}}

    <!-- Modal -->
    <div class="modal fade" id="dynamic_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg dynamic-modal-content">
        </div>
    </div>
    <script>
        // Open modal and load wishlist
        $(document).on('click', '#desktop_wishlist_btn, #mobile_wishlist_btn', function() {
            $('#wishlist_modal_body').html(`
        <div class="text-center py-4">
            <div class="spinner-border" style="color: #764ba2;" role="status"></div>
        </div>
    `);
            $('#wishlist_modal_subtitle').text('Loading...');
            $('#wishlistModal').modal('show');
            $.get('{{ route('student.wishlist.modal_items') }}',
                function(html) {
                    $('#wishlist_modal_body').html(html);
                    const count = $('.wishlist-item').length;
                    $('#wishlist_modal_subtitle').text(count + ' saved course' + (count !== 1 ? 's' : ''));
                });
        });
        // Remove from wishlist inside modal
        $(document).on('click', '.remove-wishlist-modal-btn', function() {
            const courseId = $(this).data('course-id');
            const btn = $(this);
            btn.prop('disabled', true).html('<i class="far fa-spinner fa-spin"></i>');
            $.post('{{ route('student.wishlist.toggle') }}', {
                    _token: '{{ csrf_token() }}',
                    course_id: courseId
                },
                function() {
                    $('#wishlist-item-' + courseId).fadeOut(250, function() {
                        $(this).remove();
                        syncWishlistBadge();
                    });
                });
        });
        // Hook into existing wishlist toggle buttons on page (real-time badge update)
        $(document).on('click', '.wishlist_btn', function() {
            const courseId = $(this).data('course-id');
            // Small delay to let the toggle AJAX finish first
            setTimeout(syncWishlistBadge, 600);
        });
        // Sync badge count from server
        function syncWishlistBadge() {
            $.get('{{ route('student.wishlist.modal_items') }}',
                function(html) {
                    const temp = $('<div>').html(html);
                    const count = temp.find('.wishlist-item').length;
                    $('#wishlist_count_badge, #mobile_wishlist_count_badge').text(count);
                    if (count === 0) {
                        $('#wishlist_count_badge, #mobile_wishlist_count_badge').addClass('d-none');
                    } else {
                        $('#wishlist_count_badge, #mobile_wishlist_count_badge').removeClass('d-none');
                    }
                    // Update subtitle if modal is still open
                    if ($('#wishlistModal').hasClass('show')) {
                        $('#wishlist_modal_body').html(html);
                        $('#wishlist_modal_subtitle').text(count + ' saved course' + (count !== 1 ? 's' : ''));
                    }
                });
        }
    </script>
    {{-- SCROLL BUTTON START --}}
    @include('front.layouts.components.scroll-button')
    {{-- SCROLL BUTTON END --}}
    {{-- FOOTER 3 START --}}
    @include('front.layouts.components.footer')
    {{-- FOOTER 3 END --}}
    {{-- notyf --}}
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    {{-- tiltjs --}}
    <script src="/front/js/tilt.jquery.min.js"></script>
    {{-- popper js --}}
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--larvel file manager-->
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

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

    <!--wow js-->
    <script src="/front/js/wow.min.js"></script>

    <!--main/custom js-->
    <script src="/front/js/main.js"></script>
    {{-- ez-share --}}
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>
    {{-- tinymce --}}
    <script src="/admin/assets/dist/libs/tinymce/tinymce.min.js"></script>
    @stack('scripts')
    <script>
        // const csrf_token = $('meta[name="csrf-token"]').attr('content');
        // const base_url = $('meta[name="base_url"]').attr('content');
        // // notyf — always initialized globally
        // const notyf = new Notyf({
        //     duration: 5000,
        //     dismissible: true,
        //     position: {
        //         x: 'right',
        //         y: 'bottom'
        //     },
        // });
        @if ($errors->any())
            @foreach ($errors as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
        // Wishlist toggle
        $(document).on('click', '.wishlist_btn', function() {
            const btn = $(this);
            const courseId = btn.data('course-id');
            const icon = btn.find('.wishlist-icon');
            $.ajax({
                url: "{{ route('student.wishlist.toggle') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    course_id: courseId,
                },
                success: function(res) {
                    if (res.wishlisted) {
                        icon.css('filter',
                            'invert(27%) sepia(95%) saturate(7481%) hue-rotate(356deg) brightness(97%) contrast(118%)'
                        );
                        btn.attr('title', 'Remove from Wishlist');
                        notyf.success(res.message);
                    } else {
                        icon.css('filter', '');
                        btn.attr('title', 'Add to Wishlist');
                        notyf.error(res.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        notyf.error('Please login first.');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                        return;
                    }
                    notyf.error('Something went wrong. Please try again.');
                }
            });
        });
        // Add to cart
        function add_to_cart(course_id) {
            let addToCartBtn = $(`#add_to_cart_btn_${course_id}`);
            let loading = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            let checked = 'In cart<i class="fas fa-check"></i>';
            let unchecked = 'Add to cart<i class="far fa-arrow-right" aria-hidden="true"></i>';
            $.ajax({
                method: 'POST',
                url: $('meta[name="base_url"]').attr('content') + `/cart/${course_id}/store`,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                xhrFields: {
                    withCredentials: true
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
                error: function(xhr) {
                    if (xhr.status === 401) {
                        notyf.error('Please login first.');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                        return;
                    }
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
            });
        }
        // Delete confirmation
        $(function() {
            $('.btn_dynamic_delete').on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function() {
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                notyf.error(error);
                            },
                        });
                    }
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            ezShare.execute();
        });
    </script>
</body>

</html>
