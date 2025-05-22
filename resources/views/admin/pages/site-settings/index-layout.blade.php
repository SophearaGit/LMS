@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        /* responsive css */
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
                        <h3 class="card-title">Site Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="row g-0">
                                @include('admin.pages.site-settings.partials.sidebar')
                                @yield('settings-content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('general-settings-scripts')
@endsection
