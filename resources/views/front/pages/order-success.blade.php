@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-7 wow fadeInUp text-center"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="success-message">
                        <div class="icon mb-4">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #28a745;"></i>
                        </div>
                        <h2 class="mb-3">Thank you for your purchase!</h2>
                        <p class="mb-3">Your order has been successfully completed. We hope you enjoy your purchase.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
