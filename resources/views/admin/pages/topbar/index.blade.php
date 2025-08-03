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
                        <h3 class="card-title">Customize Top Bar (Homepage)</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.topbar.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email" value="{{ $topBar->email }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone" value="{{ $topBar->phone }}">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="offer_name" class="form-label">Offer Name</label>
                                        <input type="text" class="form-control" id="offer_name" name="offer_name"
                                            placeholder="Enter Offer Name" value="{{ $topBar->offer_name }}">
                                        <x-input-error :messages="$errors->get('offer_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="offer_description" class="form-label">Offer Description</label>
                                        <input type="text" class="form-control" id="offer_description"
                                            name="offer_description" placeholder="Enter Offer Description"
                                            value="{{ $topBar->offer_description }}">
                                        <x-input-error :messages="$errors->get('offer_description')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="offer_button_link" class="form-label">Offer Button Link</label>
                                        <input type="text" class="form-control" id="offer_button_link"
                                            name="offer_button_link" placeholder="Enter Offer Button Link"
                                            value="{{ $topBar->offer_button_link }}">
                                        <x-input-error :messages="$errors->get('offer_button_link')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label for="offer_button_text" class="form-label">Offer Button Text</label>
                                        <input type="text" class="form-control" id="offer_button_text"
                                            name="offer_button_text" placeholder="Enter Offer Button Text"
                                            value="{{ $topBar->offer_button_text }}">
                                        <x-input-error :messages="$errors->get('offer_button_text')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy"></i>&nbsp;
                                        Update Top Bar
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
