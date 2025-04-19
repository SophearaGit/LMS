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
                        <h3 class="card-title">Create Sub Category</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.course-sub-categories.store', $courseCategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-my-input-file-block name="image"></x-my-input-file-block>
                                </div>
                                <div class="col-md-6">
                                    <x-my-input-block name="icon" placeholder="Enter Icon Class Name Here">
                                        <x-slot name="hint">
                                            <small class="hint-text">Example: <code>
                                                    <a href="https://tabler-icons.io/" target="_blank">ti
                                                        ti-home
                                                    </a>
                                                </code>
                                            </small>
                                        </x-slot>
                                    </x-my-input-block>
                                </div>
                                <div class="col-md-12">
                                    <x-my-input-block name="name" placeholder="Enter Name Here"></x-my-input-block>
                                </div>
                                <div class="col-md-3">
                                    <x-my-input-toggle-block name="show_at_trending"
                                        label="show at trending"></x-my-input-toggle-block>
                                </div>
                                <div class="col-md-3">
                                    <x-my-input-toggle-block name="status" label="status"></x-my-input-toggle-block>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i>&nbsp;
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
