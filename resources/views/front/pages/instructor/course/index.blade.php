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
    @include('front.pages.instructor.components.breadcrum-banner')

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
                        {{-- <form action="#" class="wsus__dash_course_searchbox">
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
                        </form> --}}

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
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= round($item->reviews()->avg('rating')))
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                                <span>({{ number_format($item->reviews()->avg('rating') ?? 0, 1) }})</span>
                                                            </p>
                                                            <a class="title"
                                                                href="{{ route('courses.show', $item->slug) }}">{{ $item->title }}</a>
                                                        </td>
                                                        <td class="sale">
                                                            <p>{{ $item->enrollments()->count() }}</p>
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
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: hidden; animation-name: none;">
                        <nav aria-label="Page navigation example">
                            {{ $courses->withQueryString()->links('vendor.pagination.front.custom') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
