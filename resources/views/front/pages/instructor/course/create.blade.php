@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
@endpush
@section('content')
    {{-- BREADCRUMB START --}}
    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Add Courses</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Add Courses</li>
                            </ul>
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
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Add Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>
                        <div class="dashboard_add_courses">
                            @include('front.pages.instructor.course.components.partials.ul-nav-tab')
                            <div class="tab-content" id="pills-tabContent">
                                @if (request()->get('step') == 1 || Route::is('instructor.courses.create'))
                                    @include('front.pages.instructor.course.components.create-course-content')
                                @elseif (request()->get('step') == 2)
                                    @include('front.pages.instructor.course.components.more-course-infos')
                                @elseif (request()->get('step') == 3)
                                    @include('front.pages.instructor.course.components.main-course-content')
                                @elseif (request()->get('step') == 4)
                                    @include('front.pages.instructor.course.components.finish')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.course-tab').on('click', function(e) {
                e.preventDefault();
                let step = $(this).data('step');
                $('.course_form').find('input[name=next_step]').val(step);
                $('.course_form').trigger('submit');
            });
        });
    </script>
@endpush
