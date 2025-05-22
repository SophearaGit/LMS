@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        .nice-select:active,
        .nice-select.open,
        .nice-select:focus {
            border-color: #ececee;
        }
    </style>
@endpush
@section('content')
    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>instructor Profile</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>instructor Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.instructor.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wsus__dash_earning">
                                        <h6>CURRENT BALLANCE</h6>
                                        <h3>{{ config('settings.site_currency_icon') }} {{ $currentBallance }}</h3>
                                        <p>
                                            Total amount available for withdrawal
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wsus__dash_earning">
                                        <h6>PENDING BALLANCE</h6>
                                        <h3>{{ config('settings.site_currency_icon') }} {{ $pendingBallance }}</h3>
                                        <p>
                                            Earnings that are pending for withdrawal
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wsus__dash_earning">
                                        <h6>TOTAL PAYOUT</h6>
                                        <h3>{{ config('settings.site_currency_icon') }} {{ $totalPayout }}</h3>
                                        <p>
                                            Total amount paid to you
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Payout Details</h5>
                                        <p>
                                            Please make sure your payout
                                            information is correct before requesting a payout.
                                        </p>
                                    </div>
                                    <div class="wsus__dashboard_contant_btn">
                                        <a href="dashboard_profile_edit.html" class="common_btn">Edit Payout</a>
                                    </div>
                                </div>
                                <ul class="wsus__dashboard_profile_info">
                                    <li><span>Gateway:</span> {{ Auth::user()?->payoutGatewayInfo->gateway }}
                                    </li>
                                    <li><span>Information:</span>{!! Auth::user()?->payoutGatewayInfo->information !!}</li>
                                </ul>
                            </div>
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Request Payout</h5>
                                    </div>
                                </div>
                                <form action="{{ route('instructor.withdraws.request_payout_store') }}" method="POST"
                                    class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_info mt-3">
                                                <label>Payout Amount</label>
                                                <input type="number" id="payout_amount" name="payout_amount" min="1"
                                                    step="0.01" placeholder="Enter payout amount here.">
                                                <x-input-error :messages="$errors->get('payout_amount')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_btn">
                                                <button type="submit" class="common_btn">Request Payout</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
