@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        .nice-select:active,
        .nice-select.open,
        .nice-select:focus {
            border-color: #ececee;
        }
    </style>
@endpush
@section('content')
    @include('front.pages.student.partials.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>
                        <div class="wsus__dash_course_table">
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
                                                        Title
                                                    </th>
                                                    <th class="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                                @forelse ($enrolledCourses as $enrolledCourse)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ $enrolledCourse->course->thumbnail }}"
                                                                    alt="img" class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating">
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                                <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                                <i class="far fa-star" aria-hidden="true"></i>
                                                                <span>(5.0)</span>
                                                            </p>
                                                            <a class="title mb-1"
                                                                href="{{ route('courses.show', $enrolledCourse->course->slug) }}">{{ $enrolledCourse->course->title }}
                                                            </a>
                                                            <div class="text-muted">
                                                                Instructor: {{ $enrolledCourse->course->instructor->name }}
                                                            </div>
                                                            @php
                                                                $lessonCount = \App\Models\CourseChapterLessons::where(
                                                                    'course_id',
                                                                    $enrolledCourse->course->id,
                                                                )->count();
                                                                $finishLessonCount = \App\Models\MakeHistory::where(
                                                                    'user_id',
                                                                    Auth::id(),
                                                                )
                                                                    ->where('course_id', $enrolledCourse->course->id)
                                                                    ->where('is_completed', 1)
                                                                    ->count();
                                                            @endphp
                                                            @if ($lessonCount == $finishLessonCount)
                                                                <a target="_blank"
                                                                    href="{{ route('student.certificate.download', $enrolledCourse->course->id) }}"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="fas fa-certificate"></i>
                                                                    Donwload Certificate!
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="">
                                                            <a class="common_btn"
                                                                href="{{ route('student.enroll_courses.course_videos', $enrolledCourse->course->slug) }}">
                                                                <i class="far fa-eye mb-1" aria-hidden="true"></i>&nbsp;
                                                                Watch Course
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">
                                                            <div class="alert alert-warning" role="alert">
                                                                No courses found.
                                                            </div>
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
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: hidden; animation-name: none;">
                        <nav aria-label="Page navigation example">
                            {{ $enrolledCourses->withQueryString()->links('vendor.pagination.front.custom') }}
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
            $('select').niceSelect();
        });
    </script>
@endpush
