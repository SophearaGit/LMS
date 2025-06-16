@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')

    @include('front.pages.partials.bread-crumb')

    {{-- ABOUT 3 START --}}
    @include('front.pages.home.sections.about')
    {{-- ABOUT 3 END --}}

    @include('front.pages.about-us.counter')

    @include('front.pages.home.sections.testimonial')

@endsection
