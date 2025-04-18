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
                        <h3 class="card-title">Edit Category</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.course-categories.update', $courseCategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-2">
                                    <x-image-preview :image="$courseCategory->image" />
                                </div>
                                <div class="col-md-5">
                                    <x-my-input-file-block name="image"></x-my-input-file-block>
                                    <x-my-input-block name="name" :value="$courseCategory->name"
                                        placeholder="Enter Name Here"></x-my-input-block>
                                </div>
                                <div class="col-md-5">
                                    <x-my-input-block name="icon" :value="$courseCategory->icon"
                                        placeholder="Enter Icon Class Name Here">
                                        <x-slot name="hint">
                                            {{-- a tag to buy url hint to get icon --}}
                                            <small class="hint-text">Example: <code>
                                                    <a href="https://tabler-icons.io/" target="_blank">ti
                                                        ti-home
                                                    </a>
                                                </code>
                                            </small>
                                        </x-slot>
                                    </x-my-input-block>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <x-my-input-toggle-block name="show_at_home" label="show at home"
                                                :checked="$courseCategory->show_at_home == 1"></x-my-input-toggle-block>
                                        </div>
                                        <div class="col-md-6">
                                            <x-my-input-toggle-block name="Status" label="status"
                                                :checked="$courseCategory->status == 1"></x-my-input-toggle-block>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy"></i>&nbsp;
                                        Update
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
