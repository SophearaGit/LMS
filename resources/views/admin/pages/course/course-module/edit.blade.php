@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        /* responsive css */
        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 100%;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Courses</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-left">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11 7l-5 5l5 5" />
                                    <path d="M17 7l-5 5l5 5" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                @include('admin.pages.course.course-module.components.partials.tab')
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane {{ request()->get('step') == 1 ? 'active' : '' }}" id="basic-infos"
                                        role="tabpanel">
                                        <form action="{{ route('admin.courses.store_basic_info') }}" method="POST"
                                            enctype="multipart/form-data" class="edit_basic_info_form course_form">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $courseId }}">
                                            <input type="hidden" name="current_step" value="1">
                                            <input type="hidden" name="next_step" value="2">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Title *</label>
                                                        <input type="text" placeholder="Title" name="title"
                                                            value="{{ $course->title }}">
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control" name="title"
                                                            placeholder="Enter title here." value="{{ $course->title }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Seo description</label>
                                                        <input type="text" placeholder="Seo description"
                                                            name="seo_description" value="{{ $course->seo_description }}">
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Seo description</label>
                                                        <input type="text" class="form-control" name="seo_description"
                                                            placeholder="Enter seo description here."
                                                            value="{{ $course->seo_description }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Thumbnail *</label>
                                                        <input type="file" name="thumbnail">
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Thumbnail</label>
                                                        <input type="file" class="form-control" name="thumbnail">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Demo Video Storage
                                                            <b>(optional)</b></label>
                                                        <select class="select_js storage" style="display: none;"
                                                            name="demo_video_storage">
                                                            <option value=""> PleaseSelect </option>
                                                            <option @selected($course->demo_video_storage == 'upload') value="upload">Upload
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'youtube') value="youtube">Youtube
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'vimeo') value="vimeo">Vimeo
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'external_link') value="external_link">
                                                                External Link</option>
                                                        </select>
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <div class="form-label">Demo Video Storage <b>(optional)</b></div>
                                                        <select class="form-select storage select2"
                                                            name="demo_video_storage">
                                                            <option value=""> Please Select </option>
                                                            <option @selected($course->demo_video_storage == 'upload') value="upload">Upload
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'youtube') value="youtube">Youtube
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'vimeo') value="vimeo">Vimeo
                                                            </option>
                                                            <option @selected($course->demo_video_storage == 'external_link') value="external_link">
                                                                External Link</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="add_course_basic_info_imput">
                                                        <div
                                                            class="upload_source {{ $course->demo_video_source == 'upload' ? '' : 'd-none' }}">
                                                            <label class="form-label">Path</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <a id="lfm" data-input="thumbnail"
                                                                        data-preview="holder" class="btn btn-primary">
                                                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                                        Choose
                                                                    </a>
                                                                </span>
                                                                <input id="thumbnail" class="form-control inps_path"
                                                                    type="text" name="filepath"
                                                                    value="{{ $course->demo_video_source }}">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="link_source {{ $course->demo_video_source != 'upload' ? '' : 'd-none' }}">
                                                            <div class="mb-3">
                                                                <label class="form-label">Path</label>
                                                                <input type="text" class="form-control inps_path"
                                                                    name="demo_video_source"
                                                                    placeholder="Provide video link here."
                                                                    value="{{ $course->demo_video_source }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Price *</label>
                                                        <input type="text" placeholder="Price" name="price"
                                                            value="{{ $course->price }}">
                                                        <p>Put 0 for free</p>
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Price</label>
                                                        <input type="text" class="form-control" name="price"
                                                            placeholder="Enter price here." value="{{ $course->price }}">
                                                        <small class="form-hint">Put 0 for free course.</small>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    {{-- <div class="add_course_basic_info_imput">
                                                        <label for="#">Discount Price</label>
                                                        <input type="text" placeholder="Price" name="discount"
                                                            value="{{ $course->discount }}">
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Discount Price</label>
                                                        <input type="text" class="form-control" name="discount"
                                                            placeholder="Enter discount price here."
                                                            value="{{ $course->discount }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    {{-- <div class="add_course_basic_info_imput mb-0">
                                                        <label for="#">Description</label>
                                                        <textarea rows="8" placeholder="Description" name="description">{!! $course->description !!}
                                                    </textarea>
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" data-bs-toggle="autosize" placeholder="Type something…"
                                                            style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 59.3333px;"
                                                            name="description">{!! $course->description !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @if (request()->get('step') == 1)
                                        {{-- @include('admin.pages.course.course-module.components.basic-infos') --}}
                                    @elseif (request()->get('step') == 2)
                                        @include('admin.pages.course.course-module.components.more-infos')
                                    @elseif (request()->get('step') == 3)
                                        @include('admin.pages.course.course-module.components.course-contents')
                                    @elseif (request()->get('step') == 4)
                                        @include('admin.pages.course.course-module.components.finish')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const base_url = $('meta[name="base_url"]').attr('content');
        const update_url = base_url + '/admin/courses/update-more-info';

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
                    let errors = xhr.responseJSON.errors;
                    const notyf = new Notyf({
                        duration: 8000,
                        dismissible: true,
                        position: {
                            x: 'right',
                            y: 'top',
                        },
                    });
                    $.each(errors, function(key, value) {
                        notyf.error(value[0])
                    })
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

        // DELETE LESSON
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        var delete_url = null;

        $('.delete-item').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            delete_url = url;
            $('#modal-danger').modal('show');
        });

        $('.delete-confirm-btn').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'DELETE',
                url: delete_url,
                data: {
                    _token: csrf_token
                },
                beforeSend: function() {
                    $('.delete-confirm-btn').text('Deleting...');
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    let errMsg = xhr.responseJSON.message;
                    notyf.error(errMsg);
                }
            });
        });

        // CHANGE INPUT PATH BASE ON SELECTED STORAGE
        $('.storage').on('change', function() {
            let storage_val = $(this).val();
            $('.inps_path').val('');
            if (storage_val == 'upload') {
                $('.upload_source').removeClass('d-none');
                $('.link_source').addClass('d-none');
            } else {
                $('.upload_source').addClass('d-none');
                $('.link_source').removeClass('d-none');
            }
        });
        // LARAVEL FILE MANAGEER INITIALIZATION
        $('#lfm').filemanager('file', {
            prefix: '/admin/laravel-filemanager'
        });
    </script>
@endpush
