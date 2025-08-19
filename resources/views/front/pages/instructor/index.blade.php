{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    {{-- BREADCRUMB START --}}
    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Instructor Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Instructor Dashboard</li>
                            </ul>ss
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}
    {{-- DASHBOARD OVERVIEW START --}}
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.instructor.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        @if (auth()->user()->approval_status === 'pending')
                            <div class="col-xl-12 col-sm-12 wow fadeInUp">
                                <div
                                    class="wsus__dash_earning d-flex align-items-center flex-wrap
                                @if (auth()->user()->approval_status === 'pending') justify-content-between
                                @else justify-content-end @endif">
                                    @if (auth()->user()->approval_status === 'pending')
                                        <div class="alert alert-primary m-0  col-8" role="alert">
                                            Your request to become an instructor has been submitted and is currently under
                                            review. <br> We'll notify you once it's approved!
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color: #fbebeb;">
                                <h6><span class="fw-semibold" style="color: #d63939;">Rejected</span> <small>Courses</small>
                                </h6>
                                <h3>{{ $rejectedCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color:#fef5e6;">
                                <h6><span class="fw-semibold" style="color: #f59f00;">Pending</span> <small>Courses</small>
                                </h6>
                                <h3>{{ $pendingCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color:#eaf7ec;">
                                <h6><span class="fw-semibold" style="color: #2fb344;">Approved</span> <small>Courses</small>
                                </h6>
                                <h3>{{ $approvedCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top">
                                    <div class="wsus__dashboard_heading wow fadeInUp"
                                        style="visibility: visible; animation-name: fadeInUp;">
                                        <h5>Best Selling Courses</h5>
                                    </div>
                                </div>

                                <div class="wsus__dash_course_table wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th class="image">
                                                                COURSES
                                                            </th>
                                                            <th class="details">

                                                            </th>
                                                            <th class="sale">
                                                                SALES
                                                            </th>
                                                            <th class="amount">
                                                                AMOUNT
                                                            </th>
                                                        </tr>

                                                        @forelse ($orderItems as $item)
                                                            <tr>
                                                                <td class="image">
                                                                    <div class="image_category">
                                                                        <img src="{{ $item->course->thumbnail }}"
                                                                            alt="{{ $item->course->title }}"
                                                                            class="img-fluid w-100">
                                                                    </div>
                                                                </td>
                                                                <td class="details">
                                                                    <p class="rating">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= round($item->course->reviews()->avg('rating')))
                                                                                <i class="fas fa-star"></i>
                                                                            @else
                                                                                <i class="far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                        <span>({{ number_format($item->course->reviews()->avg('rating') ?? 0, 1) }})</span>
                                                                    </p>
                                                                    <a class="title"
                                                                        href="{{ route('courses.show', $item->course->slug) }}">{{ $item->course->title }}</a>
                                                                </td>
                                                                <td class="sale">
                                                                    <p>34</p>
                                                                </td>
                                                                <td class="amount">
                                                                    <p>$3,145.23</p>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">
                                                                    No item in order.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
