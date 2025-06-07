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
                        <h3 class="card-title text-capitalize">customize become instructor section (homepage)</h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.become-instructor.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        @if ($sectionItems->img)
                                            <div class="mb-4 col-md-4">
                                                <a data-fslightbox="gallery" target="_blank"
                                                    href="{{ asset($sectionItems->img) }}">
                                                    <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                        style="background-image: url({{ asset($sectionItems->img) }});">
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        <label for="img" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="img" name="img"
                                            accept="image/*">
                                        <input type="hidden" name="old_img" value="{{ $sectionItems?->img }}">
                                        <x-input-error :messages="$errors->get('img')" class="mt-2" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <input type="text" class="form-control" id="icon" name="icon"
                                            placeholder="Enter icon class or URL" value="{{ $sectionItems?->icon }}">
                                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="label" class="form-label">Label</label>
                                        <input type="text" class="form-control" id="label" name="label"
                                            placeholder="Enter label" value="{{ $sectionItems?->label }}">
                                        <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" value="{{ $sectionItems?->title }}">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="btn_txt" class="form-label">Button Text</label>
                                        <input type="text" class="form-control" id="btn_txt" name="btn_txt"
                                            placeholder="Enter button text" value="{{ $sectionItems?->btn_txt }}">
                                        <x-input-error :messages="$errors->get('btn_txt')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="btn_txt_url" class="form-label">Button URL</label>
                                        <input type="text" class="form-control" id="btn_txt_url" name="btn_txt_url"
                                            placeholder="Enter button URL" value="{{ $sectionItems?->btn_txt_url }}">
                                        <x-input-error :messages="$errors->get('btn_txt_url')" class="mt-2" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="btn_icon" class="form-label">Button Icon</label>
                                        <input type="text" class="form-control" id="btn_icon" name="btn_icon"
                                            placeholder="Enter button icon class or URL"
                                            value="{{ $sectionItems?->btn_icon }}">
                                        <x-input-error :messages="$errors->get('btn_icon')" class="mt-2" />
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control editor" id="description" name="description" placeholder="Enter description">{!! $sectionItems->description !!}</textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                            Update Section
                                        </button>
                                    </div>
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
    </script>
@endpush
