@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-7 wow fadeInUp text-center"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="failure-message">
                        <div class="icon mb-4">
                            <i class="fas fa-times-circle" style="font-size: 4rem; color: #dc3545;"></i>
                        </div>
                        <h2 class="mb-3">Payment Failed</h2>
                        <p class="mb-3">Failed to purchase the course. Please try again later.</p>
                        <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
