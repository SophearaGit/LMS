@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        .wsus__dash_course_table .image img {
            /* width: 160px !important;
            border-radius: 10px; */
            height: 120px !important;
            object-fit: cover !important;
        }
    </style>
@endpush
@section('content')
    {{-- BREADCRUMB START --}}
    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Courses</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Courses</li>
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
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
                            </div>
                        </div>
                        <form action="#" class="wsus__dash_course_searchbox">
                            <div class="input">
                                <input type="text" placeholder="Search our Courses">
                                <button><i class="far fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="selector">
                                <select class="select_js" style="display: none;">
                                    <option value="">Choose</option>
                                    <option value="">Choose 1</option>
                                    <option value="">Choose 2</option>
                                </select>
                            </div>
                        </form>

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

                                                    </th>
                                                    <th class="sale">
                                                        STUDENT
                                                    </th>
                                                    <th class="status">
                                                        STATUS
                                                    </th>
                                                    <th class="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                                @forelse ($courses as $item)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ $item->thumbnail }}" alt="img"
                                                                    class="img-fluid w-100">
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
                                                            <a class="title" href="#">{{ $item->title }}</a>
                                                        </td>
                                                        <td class="sale">
                                                            <p>3400</p>
                                                        </td>
                                                        <td class="status">
                                                            <p class="active">{{ $item->status }}</p>
                                                        </td>
                                                        <td class="action">
                                                            <a class="edit"
                                                                href="{{ route('instructor.courses.edit_basic_info', ['id' => $item->id, 'step' => 1]) }}"><i
                                                                    class="far fa-edit" aria-hidden="true"></i></a>
                                                            <a class="del" href="#"><i class="fas fa-trash-alt"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="mt-3">
                                                        <td colspan="5" class="text-center">
                                                            <span class="badge rounded-pill text-bg-danger">
                                                                No courses have been posted yet. Start creating your first
                                                                course to engage with students.
                                                            </span>
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
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
