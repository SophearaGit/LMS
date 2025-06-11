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
                        <h3 class="card-title text-capitalize">edit brand</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.brand-section.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.brand-section.update', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @if ($brand->image)
                                    <div class="col-md-2 mb-3">
                                        <a data-fslightbox="gallery" href="{{ asset($brand->image) }}" target="_blank">
                                            <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                                style="background-image: url({{ asset($brand->image) }})">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            placeholder="Enter background image URL here." accept="image/*"
                                            value="{{ $brand->image }}">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="url" class="form-label">URL</label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Enter video URL here." value="{{ $brand->url }}">
                                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="0" @selected($brand->status == 0)>
                                                Inactive
                                            </option>
                                            <option value="1" @selected($brand->status == 1)>
                                                Active
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
