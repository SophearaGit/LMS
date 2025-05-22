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
                        <h3 class="card-title">Create Payout Gateway</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.payout-gateways.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left mb-1"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payout-gateways.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Gateway Name.">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="6"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy mb-1"></i>&nbsp;
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
