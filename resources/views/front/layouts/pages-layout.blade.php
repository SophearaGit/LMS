<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="base_url" content="{{ url('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
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
    @stack('stylesheets')
</head>

<body class="home_3">

    {{-- PRELOADER START --}}
    @include('front.layouts.components.preloader')
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


    {{-- SCROLL BUTTON START --}}
    @include('front.layouts.components.scroll-button')
    {{-- SCROLL BUTTON END --}}

    {{-- FOOTER 3 START --}}
    @include('front.layouts.components.footer')
    {{-- FOOTER 3 END --}}

    <!--jquery library js-->
    <script src="/front/js/jquery-3.7.1.min.js"></script>
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
    @stack('scripts')

</body>

</html>
