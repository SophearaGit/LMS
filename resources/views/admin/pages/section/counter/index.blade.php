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
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.counter-section.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="counter_one" class="form-label">Counter One</label>
                                        <input type="text" class="form-control" id="counter_one" name="counter_one"
                                            placeholder="Enter counter one" value="{{ $counterItems?->counter_one }}">
                                        <x-input-error :messages="$errors->get('counter_one')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title_one" class="form-label">Title One</label>
                                        <input type="text" class="form-control" id="title_one" name="title_one"
                                            placeholder="Enter title one" value="{{ $counterItems?->title_one }}">
                                        <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="counter_two" class="form-label">Counter Two</label>
                                        <input type="text" class="form-control" id="counter_two" name="counter_two"
                                            placeholder="Enter counter two" value="{{ $counterItems?->counter_two }}">
                                        <x-input-error :messages="$errors->get('counter_two')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title_two" class="form-label">Title Two</label>
                                        <input type="text" class="form-control" id="title_two" name="title_two"
                                            placeholder="Enter title two" value="{{ $counterItems?->title_two }}">
                                        <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="counter_three" class="form-label">Counter Three</label>
                                        <input type="text" class="form-control" id="counter_three" name="counter_three"
                                            placeholder="Enter counter three" value="{{ $counterItems?->counter_three }}">
                                        <x-input-error :messages="$errors->get('counter_three')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title_three" class="form-label">Title Three</label>
                                        <input type="text" class="form-control" id="title_three" name="title_three"
                                            placeholder="Enter title three" value="{{ $counterItems?->title_three }}">
                                        <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="counter_four" class="form-label">Counter Four</label>
                                        <input type="text" class="form-control" id="counter_four" name="counter_four"
                                            placeholder="Enter counter four" value="{{ $counterItems?->counter_four }}">
                                        <x-input-error :messages="$errors->get('counter_four')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title_four" class="form-label">Title Four</label>
                                        <input type="text" class="form-control" id="title_four" name="title_four"
                                            placeholder="Enter title four" value="{{ $counterItems?->title_four }}">
                                        <x-input-error :messages="$errors->get('title_four')" class="mt-2" />
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
