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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-capitalize">
                            customize about us section (homepage)
                        </h3>
                        <div class="card-actions"></div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.about-section.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Image --}}
                                <div class="mb-3 col-12">
                                    @if ($aboutUsSectionItems->image)
                                        <div class="mb-4 col-4">
                                            <a data-fslightbox="gallery" target="_blank"
                                                href="{{ asset($aboutUsSectionItems->image) }}">
                                                <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                    style="background-image: url({{ asset($aboutUsSectionItems->image) }});">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Image URL">
                                    <input type="hidden" name="old_image" value="{{ $aboutUsSectionItems->image }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                {{-- Rounded Text --}}
                                <div class="mb-3 col-12">
                                    <label for="rounded_text" class="form-label">Rounded Text</label>
                                    <input type="text" class="form-control" id="rounded_text" name="rounded_text"
                                        placeholder="Enter Rounded Text" value="{{ $aboutUsSectionItems->rounded_text }}">
                                    <x-input-error :messages="$errors->get('rounded_text')" class="mt-2" />
                                </div>

                                {{-- Lerner Count --}}
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="lerner_count" class="form-label">Lerner Count</label>
                                    <input type="number" class="form-control" id="lerner_count" name="lerner_count"
                                        placeholder="Enter Lerner Count" value="{{ $aboutUsSectionItems->lerner_count }}">
                                    <x-input-error :messages="$errors->get('lerner_count')" class="mt-2" />
                                </div>

                                {{-- Lerner Count Text --}}
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="lerner_count_text" class="form-label">Lerner Count Text</label>
                                    <input type="text" class="form-control" id="lerner_count_text"
                                        name="lerner_count_text" placeholder="Enter Lerner Count Text"
                                        value="{{ $aboutUsSectionItems->lerner_count_text }}">
                                    <x-input-error :messages="$errors->get('lerner_count_text')" class="mt-2" />
                                </div>

                                {{-- Lerner Image --}}
                                <div class="mb-3 col-12">
                                    @if ($aboutUsSectionItems->lerner_image)
                                        <div class="mb-4 col-4">
                                            <a data-fslightbox="gallery" target="_blank"
                                                href="{{ asset($aboutUsSectionItems->lerner_image) }}">
                                                <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                    style="background-image: url({{ asset($aboutUsSectionItems->lerner_image) }});">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <label for="lerner_image" class="form-label">Lerner Image</label>
                                    <input type="file" class="form-control" id="lerner_image" name="lerner_image"
                                        placeholder="Enter Lerner Image URL">
                                    <input type="hidden" name="old_lerner_image"
                                        value="{{ $aboutUsSectionItems->lerner_image }}">
                                    <x-input-error :messages="$errors->get('lerner_image')" class="mt-2" />
                                </div>

                                {{-- Title --}}
                                <div class="mb-3 col-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ $aboutUsSectionItems->title }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                {{-- Description --}}
                                <div class="mb-3 col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control editor" id="description" name="description" rows="5"
                                        placeholder="Enter Description">{!! $aboutUsSectionItems->description !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                {{-- Button Text --}}
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text"
                                        placeholder="Enter Button Text" value="{{ $aboutUsSectionItems->button_text }}">
                                    <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                </div>

                                {{-- Button URL --}}
                                <div class="mb-3 col-12 col-md-6">
                                    <label for="button_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="button_url" name="button_url"
                                        placeholder="Enter Button URL" value="{{ $aboutUsSectionItems->button_url }}">
                                    <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                </div>

                                {{-- Video URL --}}
                                <div class="mb-3 col-12">
                                    <label for="video_url" class="form-label">Video URL</label>
                                    <input type="text" class="form-control" id="video_url" name="video_url"
                                        placeholder="Enter Video URL" value="{{ $aboutUsSectionItems->video_url }}">
                                    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                </div>

                                {{-- Video Image --}}
                                <div class="mb-3 col-12">
                                    @if ($aboutUsSectionItems->video_image)
                                        <div class="mb-4 col-4">
                                            <a data-fslightbox="gallery" target="_blank"
                                                href="{{ asset($aboutUsSectionItems->video_image) }}">
                                                <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                    style="background-image: url({{ asset($aboutUsSectionItems->video_image) }});">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <label for="video_image" class="form-label">Video Image</label>
                                    <input type="file" class="form-control" id="video_image" name="video_image"
                                        placeholder="Enter Video Image URL">
                                    <input type="hidden" name="old_video_image"
                                        value="{{ $aboutUsSectionItems->video_image }}">
                                    <x-input-error :messages="$errors->get('video_image')" class="mt-2" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i>&nbsp;
                                <span>Save</span>
                            </button>
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
    </script>
@endpush
