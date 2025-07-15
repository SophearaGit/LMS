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
                        <h3 class="card-title">Edit Custom Page</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.custom-page.index') }}" class="btn btn-primary">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.custom-page.update', $customPage) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ $customPage->title }}">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Enter Slug" value="{{ $customPage->title }}">
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control editor" id="description" name="description" rows="4"
                                        placeholder="Enter Description">{!! $customPage->description !!}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="seo_title" class="form-label">SEO Title</label>
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        placeholder="Enter SEO Title" value="{{ $customPage->seo_title }}">
                                    <x-input-error :messages="$errors->get('seo_title')" class="mt-2" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="seo_description" class="form-label">SEO Description</label>
                                    <textarea class="form-control" id="seo_description" name="seo_description" rows="3"
                                        placeholder="Enter SEO Description">{!! $customPage->seo_description !!}</textarea>
                                    <x-input-error :messages="$errors->get('seo_description')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="show_at_nav" class="form-label">Show at Navigation</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="show_at_nav" name="show_at_nav"
                                            value="1" {{ $customPage->show_at_nav == 1 ? 'checked' : '' }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('show_at_nav')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status"
                                            value="1" {{ $customPage->status == 1 ? 'checked' : '' }}>
                                    </div>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
    </script>
@endpush
