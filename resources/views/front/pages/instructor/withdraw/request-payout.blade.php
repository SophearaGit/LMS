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
                                        <h3>{{ config('settings.site_currency_icon') }}
                                            {{ number_format(floor(($currentBallance ?? 0) * 100) / 100, 2) }}
                                        </h3>
                                        <p>
                                            Total amount available for withdrawal
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wsus__dash_earning">
                                        <h6>PENDING BALLANCE</h6>
                                        <h3>{{ config('settings.site_currency_icon') }}
                                            {{ number_format(floor(($pendingBallance ?? 0) * 100) / 100, 2) }}
                                        </h3>
                                        <p>
                                            Earnings that are pending for withdrawal
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wsus__dash_earning">
                                        <h6>TOTAL PAYOUT</h6>
                                        <h3>{{ config('settings.site_currency_icon') }}
                                            {{ number_format(floor(($totalPayout ?? 0) * 100) / 100, 2) }}
                                        </h3>
                                        <p>
                                            Total amount paid to you
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Request Payout</h5>
                                        <p class="text-muted">
                                            Make sure to setup your payout settings before requesting.
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ route('instructor.withdraws.request_payout_store') }}" method="POST"
                                    class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_info mt-3">
                                                <label>Payout Amount</label>
                                                {{-- <input type="number" id="payout_amount" name="payout_amount" min="1"
                                                    step="0.01" placeholder="Enter payout amount here."> --}}
                                                <input type="text" id="payout_amount" name="payout_amount"
                                                    class="form-control" inputmode="decimal"
                                                    placeholder="Enter payout amount here"
                                                    oninput="this.value = this.value
                                                    .replace(/\s+/g, '')
                                                    .replace(/[^0-9.]/g, '')
                                                    .replace(/(\..*)\./g, '$1')" />
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
                            {{-- <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Payout Details</h5>
                                        <p>
                                            Please make sure your payout
                                            information is correct before requesting a payout.
                                        </p>
                                    </div>
                                    <div class="wsus__dashboard_contant_btn">
                                        <a href="{{ route('instructor.profile') }}#payout_details" class="common_btn">Edit
                                            Payout</a>
                                    </div>
                                </div>
                                <ul class="wsus__dashboard_profile_info">
                                    <li><span>Gateway:</span> {{ Auth::user()?->payoutGatewayInfo->gateway }}
                                    </li>
                                    <li><span>Information:</span>{!! Auth::user()?->payoutGatewayInfo->information !!}</li>
                                </ul>
                            </div> --}}
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Payout Settings</h5>
                                        <p class="text-muted">
                                            Please select your payment gateway and provide information.
                                        </p>
                                    </div>
                                </div>
                                <div class="wsus__dashboard_password_change p-0">
                                    <form action="{{ route('instructor.profile.update_payout') }}" method="POST"
                                        class="wsus__dashboard_profile_update" id="profileForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="wsus__dashboard_password_change_input">
                                                    @foreach ($payoutGateways as $payoutGateway)
                                                        <span
                                                            class="d-none gateway-{{ $payoutGateway->id }}">{!! $payoutGateway->description !!}</span>
                                                    @endforeach
                                                    <label for="gateway">Gateway</label>
                                                    <select class="mt-2 gateway" name="gateway" id="gateway">
                                                        <option data-display="Select your gateway here." value="">
                                                            Nothing
                                                        </option>
                                                        @foreach ($payoutGateways as $payoutGateway)
                                                            <option @selected($payoutGateway->name == optional(auth()->user()->payoutGatewayInfo)->gateway)
                                                                value="{{ $payoutGateway->name }}"
                                                                data-id="{{ $payoutGateway->id }}">
                                                                {{ $payoutGateway->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('gateway')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__dashboard_password_change_input mb-3">
                                                    <label for="gateway_information">Information</label>
                                                    <textarea rows="7" class="gateway_description editor" name="gateway_information" id="gateway_information"
                                                        placeholder="Enter your gateway info here.">{!! optional(auth()->user()->payoutGatewayInfo)->information !!}</textarea>
                                                    <x-input-error :messages="$errors->get('gateway_information')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__dashboard_password_change_btn">
                                                    <button type="submit" class="common_btn">Update</button>
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
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '.editor',

                base_url: '/admin/assets/dist/libs/tinymce',
                suffix: '.min',

                plugins: 'advlist autolink lists link image charmap preview ' +
                    'anchor searchreplace visualblocks code fullscreen ' +
                    'insertdatetime media table help wordcount',

                link_default_protocol: 'https',
                convert_urls: false
            });
        });

        $('.gateway').on('change', function() {
            let id = $(this).find(':selected').data('id');
            $('.gateway_description').attr('placeholder', $('.gateway-' + id).html());
        });

        $(document).ready(function() {
            $('select').niceSelect();
        });


        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#profileForm');
            if (!form) return;

            form.addEventListener('submit', function() {
                const editor = tinymce.activeEditor;

                let content = editor.getContent({
                    format: 'html'
                });

                // convert ONLY plain URLs (not already linked)
                content = content.replace(
                    /(^|[\s>])((https?:\/\/)[^\s<]+)/g,
                    function(match, prefix, url) {
                        return prefix + '<a href="' + url + '" target="_blank" rel="noopener">' + url +
                            '</a>';
                    }
                );

                editor.setContent(content);
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
