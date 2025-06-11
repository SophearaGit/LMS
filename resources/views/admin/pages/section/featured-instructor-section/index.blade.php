@extends('admin.layouts.master')

@section('pageTitle', $pageTitle ?? 'Page Title Here')

@push('stylesheets')
    <style>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-capitalize mb-0">
                            customize featured instructor section (homepage)
                        </h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.featured-instructor-section.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title here."
                                        value="{{ $featuredInstructorSectionItems?->title }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <textarea class="form-control" id="subtitle" name="subtitle" placeholder="Enter subtitle here." rows="3">{!! $featuredInstructorSectionItems?->subtitle !!}</textarea>
                                    <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text"
                                        placeholder="Enter button text here."
                                        value="{{ $featuredInstructorSectionItems?->button_text }}">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="button_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="button_url" name="button_url"
                                        placeholder="Enter button URL here."
                                        value="{{ $featuredInstructorSectionItems?->button_url }}">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="instructor_id" class="form-label">Instructor</label>
                                    <select class="form-control select2 instructor_select" id="instructor_id"
                                        name="instructor_id">
                                        <option value="">Select instructor</option>
                                        @foreach ($instructors as $instructor)
                                            <option @selected($featuredInstructorSectionItems?->instructor_id == $instructor->id) value="{{ $instructor->id }}">
                                                {{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="featured_courses" class="form-label">Course</label>
                                    <select class="form-control select2 instructor_courses" name="featured_courses[]"
                                        multiple>
                                        @foreach ($selectedInstructorCourses as $course)
                                            <option @selected(in_array($course->id, $selectedCourses)) value="{{ $course->id }}">
                                                {{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('featured_courses')" class="mt-2" />
                                </div>

                                {{-- instructor_image --}}
                                <div class="mb-3 col-md-12">
                                    @if ($featuredInstructorSectionItems?->instructor_image)
                                        <div class="mb-4 col-md-2">
                                            <a data-fslightbox="gallery" target="_blank"
                                                href="{{ asset($featuredInstructorSectionItems?->instructor_image) }}">
                                                <!-- Photo -->
                                                <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                    style="background-image: url({{ asset($featuredInstructorSectionItems?->instructor_image) }});">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <label for="instructor_image" class="form-label">Instructor Image</label>
                                    <input type="file" class="form-control" id="instructor_image" name="instructor_image"
                                        accept="image/*">
                                    <input type="hidden" name="old_image"
                                        value="{{ $featuredInstructorSectionItems?->instructor_image }}">
                                    <x-input-error :messages="$errors->get('instructor_image')" class="mt-2" />
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy"></i>&nbsp;
                                        <span class="mt-1">Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const baseUrl = $('meta[name="base_url"]').attr('content');
        const csrfToken = $('meta[name="csrf_token"]').attr('content');

        $(function() {
            $('.select2').select2();
            $('.instructor_select').on('change', function() {
                var instructorId = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: `${baseUrl}/admin/get-instructor-courses/${instructorId}`,
                    beforeSend: function() {
                        $('.instructor_courses').empty();
                    },
                    success: function(data) {
                        $.each(data.instructorCourses, function(key, value) {
                            $('.instructor_courses').append(
                                `<option value="${value.id}">${value.title}</option>`
                            );
                        });
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });

        });
    </script>
@endpush
