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
                        <h3 class="card-title text-capitalize">create testimonial</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.testimonial-section.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left"></i>&nbsp;
                                <span>Back to List</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.testimonial-section.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating</label>
                                        <select class="form-select" id="rating" name="rating" required>
                                            <option value="" disabled selected>Select rating</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}"> {{ $i }}</option>
                                            @endfor
                                        </select>
                                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review</label>
                                        <textarea class="form-control" id="review" name="review" rows="4" placeholder="Enter review" required></textarea>
                                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="user_image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="user_image" name="user_image"
                                            accept="image/*" required>
                                        <input type="hidden" name="old_img" value="">
                                        <x-input-error :messages="$errors->get('user_image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="user_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name"
                                            value="" placeholder="Enter user name" required>
                                        <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="user_title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="user_title" name="user_title"
                                            value="" placeholder="Enter user title" required>
                                        <x-input-error :messages="$errors->get('user_title')" class="mt-2" />
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
