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
                        <h3 class="card-title text-capitalize">customize hero section (homepage)</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="label" class="form-label">Label</label>
                                    <input type="text" class="form-control" id="label" name="label"
                                        placeholder="Enter Label" value="{{ $heroItems->label }}">
                                    <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ $heroItems->title }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="subtitle" class="form-label">Subtitle <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                                        placeholder="Enter Subtitle" value="{{ $heroItems->subtitle }}">
                                    <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="btn_txt" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="btn_txt" name="btn_txt"
                                        placeholder="Enter Button Text" value="{{ $heroItems->btn_txt }}">
                                    <x-input-error :messages="$errors->get('btn_txt')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="btn_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="btn_url" name="btn_url"
                                        placeholder="Enter Button URL" value="{{ $heroItems->btn_url }}">
                                    <x-input-error :messages="$errors->get('btn_url')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="vid_btn_txt" class="form-label">Video Button Text</label>
                                    <input type="text" class="form-control" id="vid_btn_txt" name="vid_btn_txt"
                                        placeholder="Enter Video Button Text" value="{{ $heroItems->vid_btn_txt }}">
                                    <x-input-error :messages="$errors->get('vid_btn_txt')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="vid_btn_url" class="form-label">Video Button URL</label>
                                    <input type="text" class="form-control" id="vid_btn_url" name="vid_btn_url"
                                        placeholder="Enter Video Button URL" value="{{ $heroItems->vid_btn_url }}">
                                    <x-input-error :messages="$errors->get('vid_btn_url')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="banner_item_title" class="form-label">Banner Item Title</label>
                                    <input type="text" class="form-control" id="banner_item_title"
                                        name="banner_item_title" placeholder="Enter Banner Item Title"
                                        value="{{ $heroItems->banner_item_title }}">
                                    <x-input-error :messages="$errors->get('banner_item_title')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="banner_item_subtitle" class="form-label">Banner Item Subtitle</label>
                                    <input type="text" class="form-control" id="banner_item_subtitle"
                                        name="banner_item_subtitle" placeholder="Enter Banner Item Subtitle"
                                        value="{{ $heroItems->banner_item_subtitle }}">
                                    <x-input-error :messages="$errors->get('banner_item_subtitle')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    @if ($heroItems->image)
                                        <div class="mb-4">
                                            <a data-fslightbox="gallery" target="_blank"
                                                href="{{ asset($heroItems->image) }}">
                                                <!-- Photo -->
                                                <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                    style="background-image: url({{ asset($heroItems->image) }});">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    <input type="hidden" name="old_image"
                                        value="{{ $heroItems->image ? $heroItems->image : '' }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="round_txt" class="form-label">Round Text</label>
                                    <input type="text" class="form-control" id="round_txt" name="round_txt"
                                        placeholder="Enter Round Text" value="{{ $heroItems->round_txt }}">
                                    <x-input-error :messages="$errors->get('round_txt')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                        Save
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
<script src="/admin/assets/dist/libs/fslightbox.index.js"></script>
