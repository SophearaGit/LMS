@extends('admin.layouts.master')

@section('pageTitle', $pageTitle ?? 'Page Title Here')

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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-capitalize mb-0">
                            customize features section (homepage)
                        </h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left"></i>
                                <span class="mt-1">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($featureItems as $featureItem)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mb-3 text-capitalize">
                                        feature:
                                        <span class="badge bg-warning text-light">{{ $featureItem->id }}</span>
                                    </h4>
                                    <form action="{{ route('admin.features.store', ['feature' => $featureItem->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            @if ($featureItem->icon)
                                                <div class="mb-4 col-4 bg-primary">
                                                    <a data-fslightbox="gallery" target="_blank"
                                                        href="{{ asset($featureItem->icon) }}">
                                                        <div class="img-responsive img-responsive-4x1 rounded-3 border"
                                                            style="background-image: url({{ asset($featureItem->icon) }});">
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                            <label for="icon1" class="form-label">Icon Image</label>
                                            <input type="file" class="form-control" id="icon1" name="icon"
                                                accept="image/*">
                                            <input type="hidden" name="old_icon" value="{{ $featureItem->icon }}">
                                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="title1" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title1" name="title"
                                                placeholder="Enter Title" value="{{ $featureItem->title }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="description1" class="form-label">Description</label>
                                            <textarea class="form-control" id="description1" name="description" rows="3" placeholder="Enter Description">{!! $featureItem->description !!}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-device-floppy"></i>&nbsp;
                                            <span class="mt-1">Save</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
