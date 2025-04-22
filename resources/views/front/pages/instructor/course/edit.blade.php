@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    {{-- BREADCRUMB START --}}
    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Edit Courses</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Edit Courses</li>
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
                                <h5>Edit Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>
                        <div class="dashboard_add_courses">
                            @include('front.pages.instructor.course.components.ul-nav-tab')
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade {{ Route::is('instructor.courses.edit_basic_info', ['id' => $courseId, 'step' => 1]) ? 'show active' : '' }}"
                                    id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="add_course_basic_info">
                                        <form action="{{ route('instructor.courses.store_basic_info') }}" method="POST"
                                            enctype="multipart/form-data" class="edit_basic_info_form course_form">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $courseId }}">
                                            <input type="hidden" name="current_step" value="1">
                                            <input type="hidden" name="next_step" value="2">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Title *</label>
                                                        <input type="text" placeholder="Title" name="title"
                                                            value="{{ $course->title }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Seo description</label>
                                                        <input type="text" placeholder="Seo description"
                                                            name="seo_description" value="{{ $course->seo_description }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Thumbnail *</label>
                                                        <input type="file" name="thumbnail">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Demo Video Storage <b>(optional)</b></label>
                                                        <select class="select_js" style="display: none;"
                                                            name="demo_video_storage">
                                                            <option value=""> Please Select </option>
                                                            <option value="upload">Upload</option>
                                                            <option value="youtube">Youtube</option>
                                                            <option value="vimeo">Vimeo</option>
                                                            <option value="external_link">External Link</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Path</label>
                                                        <input type="file" name="demo_video_source">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Price *</label>
                                                        <input type="text" placeholder="Price" name="price"
                                                            value="{{ $course->price }}">
                                                        <p>Put 0 for free</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_imput">
                                                        <label for="#">Discount Price</label>
                                                        <input type="text" placeholder="Price" name="discount">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="add_course_basic_info_imput mb-0">
                                                        <label for="#">Description</label>
                                                        <textarea rows="8" placeholder="Description" name="description">{!! $course->description !!}
                                                        </textarea>
                                                        <button type="submit" class="common_btn mt_20">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
@push('scripts')
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const update_url = base_url + '/instructor/courses/update-more-info';

        $('.edit_basic_info_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: update_url,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.status == 'success') {
                        window.location.href = data.redirect;
                    }
                },
                error: function(xhr, status, error) {

                },
                complete: function() {

                }
            });
        });

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
