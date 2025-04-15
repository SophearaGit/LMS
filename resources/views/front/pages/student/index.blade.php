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
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Student Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}
    {{-- DASHBOARD OVERVIEW START --}}
    <!-- Session Status -->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
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
                                <div class="col-3">
                                    <a href="{{ route('student.become_instructor') }}" class="common_btn">
                                        Become An Instructor?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>REVENUE</h6>
                                <h3>$2456.34</h3>
                                <p>Earning this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>STUDENTS ENROLLMENTS</h6>
                                <h3>16,450</h3>
                                <p>Progress this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>COURSES RATING</h6>
                                <h3>4.70</h3>
                                <p>Rating this month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
