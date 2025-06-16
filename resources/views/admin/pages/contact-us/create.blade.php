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
                        <h3 class="card-title text-capitalize">create contact</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.contact-us.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left"></i>&nbsp;
                                <span>Back to List</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.contact-us.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="" placeholder="Enter title">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="line_one" class="form-label">Line One</label>
                                        <input type="text" class="form-control" id="line_one" name="line_one"
                                            value="" placeholder="Enter line one">
                                        <x-input-error :messages="$errors->get('line_one')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="line_two" class="form-label">Line Two</label>
                                        <input type="text" class="form-control" id="line_two" name="line_two"
                                            value="" placeholder="Enter line two">
                                        <x-input-error :messages="$errors->get('line_two')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="1" selected>Active
                                            </option>
                                            <option value="0">Inactive
                                            </option>
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
