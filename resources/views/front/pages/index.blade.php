@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')

    {{-- BANNER 3 START --}}
    @include('front.pages.home.sections.banner')
    {{-- BANNER 3 END --}}


    {{-- CATEGORY 4 START --}}
    @include('front.pages.home.sections.category')
    {{-- CATEGORY 4 END --}}


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
