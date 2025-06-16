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
                        <h3 class="card-title text-capitalize">create brand</h3>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($contactSetting?->image)
                                        <div class="col-md-2 mb-3">
                                            <a data-fslightbox="gallery" href="{{ asset($contactSetting?->image) }}"
                                                target="_blank">
                                                <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                                    style="background-image: url({{ asset($contactSetting?->image) }})">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            placeholder="Upload image" accept="image/*">
                                        <input type="hidden" name="old_image" value="{{ $contactSetting?->image }}">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="text" class="form-label">Url</label>
                                        <input type="url" class="form-control" id="map_url" name="map_url"
                                            value="{{ $contactSetting?->map_url }}" placeholder="Enter map URL here.">
                                        <x-input-error :messages="$errors->get('map_url')" class="mt-2" />
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
