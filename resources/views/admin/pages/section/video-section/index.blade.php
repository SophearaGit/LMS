@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
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
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">customize video section (homepage)</h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.video-section.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        @if ($videoSectionItems->background_image)
                                            <div class="mb-4 col-md-2">
                                                <a data-fslightbox="gallery" target="_blank"
                                                    href="{{ asset($videoSectionItems->background_image) }}">
                                                    <!-- Photo -->
                                                    <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                        style="background-image: url({{ asset($videoSectionItems->background_image) }});">
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        <label for="background_image" class="form-label">Background Image</label>
                                        <input type="file" class="form-control" id="background_image"
                                            name="background_image" placeholder="Enter background image URL here."
                                            accept="image/*">
                                        <input type="hidden" name="old_image"
                                            value="{{ $videoSectionItems->background_image }}">
                                        <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Video URL</label>
                                        <input type="text" class="form-control" id="video_url" name="video_url"
                                            value="{{ $videoSectionItems->video_url }}" placeholder="Enter video URL here.">
                                        <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="button_text" class="form-label">Button Text</label>
                                        <input type="text" class="form-control" id="button_text" name="button_text"
                                            value="{{ $videoSectionItems->button_text }}"
                                            placeholder="Enter button text here.">
                                        <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="button_url" class="form-label">Button URL</label>
                                        <input type="text" class="form-control" id="button_url" name="button_url"
                                            value="{{ $videoSectionItems->button_url }}"
                                            placeholder="Enter button URL here.">
                                        <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control editor" id="description" name="description" rows="3"
                                            placeholder="Enter description here.">{!! $videoSectionItems->description !!}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                        <span>
                                            Save
                                        </span>
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
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '.editor',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        })
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a category',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
