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
                        <h3 class="card-title text-capitalize">edit social link</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="col-md-2 mb-3">
                                            <a data-fslightbox="gallery" href="{{ asset($socialLink->icon) }}"
                                                target="_blank">
                                                <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                                    style="background-image: url({{ asset($socialLink->icon) }})">
                                                </div>
                                            </a>
                                        </div>
                                        <label for="icon" class="form-label">Icon</label>
                                        <input type="file" class="form-control" id="icon" name="icon"
                                            accept="image/*">
                                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            value="{{ $socialLink->link }}" placeholder="Enter link">
                                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option @selected($socialLink->status == 1) value="1">Active</option>
                                            <option @selected($socialLink->status == 0) value="0">Inactive</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                        <span>Save</span>
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
