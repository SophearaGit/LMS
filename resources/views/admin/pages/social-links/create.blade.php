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
                        <h3 class="card-title text-capitalize">create social link</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left"></i>&nbsp;
                                <span>Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.social-links.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
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
                                            value="" placeholder="Enter link">
                                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
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
