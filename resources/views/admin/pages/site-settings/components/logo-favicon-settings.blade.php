@extends('admin.pages.site-settings.index-layout')
@section('settings-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.site-settings.update-logo-favicon-settings') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">Logo & Favicon Settings</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Site Logo</div>
                        @if (config('settings.site_logo'))
                            <div class="col-md-4 mb-3">
                                <a data-fslightbox="gallery" href="{{ asset(config('settings.site_logo')) }}"
                                    target="_blank">
                                    <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                        style="background-image: url({{ asset(config('settings.site_logo')) }})">
                                    </div>
                                </a>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="site_logo" accept="image/*">
                        <x-input-error :messages="$errors->get('site_logo')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Site Footer Logo</div>
                        @if (config('settings.site_footer_logo'))
                            <div class="col-md-4 mb-3">
                                <a data-fslightbox="gallery" href="{{ asset(config('settings.site_footer_logo')) }}"
                                    target="_blank">
                                    <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                        style="background-image: url({{ asset(config('settings.site_footer_logo')) }})">
                                    </div>
                                </a>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="site_footer_logo" accept="image/*">
                        <x-input-error :messages="$errors->get('site_footer_logo')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Site Favicon</div>
                        @if (config('settings.site_favicon'))
                            <div class="col-md-4 mb-3">
                                <a data-fslightbox="gallery" href="{{ asset(config('settings.site_favicon')) }}"
                                    target="_blank">
                                    <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                        style="background-image: url({{ asset(config('settings.site_favicon')) }})">
                                    </div>
                                </a>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="site_favicon" accept="image/*">
                        <x-input-error :messages="$errors->get('site_favicon')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Site Breadcrumb</div>
                        @if (config('settings.site_breadcrumb'))
                            <div class="col-md-4 mb-3">
                                <a data-fslightbox="gallery" href="{{ asset(config('settings.site_breadcrumb')) }}"
                                    target="_blank">
                                    <div class="img-responsive img-responsive-1x1 rounded-3 border"
                                        style="background-image: url({{ asset(config('settings.site_breadcrumb')) }})">
                                    </div>
                                </a>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="site_breadcrumb" accept="image/*">
                        <x-input-error :messages="$errors->get('site_breadcrumb')" class="mt-2"></x-input-error>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('general-settings-scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
