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
                                                    @php
                                                        // The editor needs HTML. Details saved as plain text keep their line breaks.
                                                        $savedInfo = (string) old('gateway_information', optional(auth()->user()->payoutGatewayInfo)->information);
                                                        if ($savedInfo !== '' && $savedInfo === strip_tags($savedInfo)) {
                                                            $savedInfo = nl2br(e($savedInfo), false);
                                                        }
                                                    @endphp
                                                    <textarea rows="7" class="gateway_description editor" name="gateway_information" id="gateway_information"
                                                        placeholder="Enter your gateway info here.">{{ $savedInfo }}</textarea>
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
        var defaultGatewayPlaceholder = 'Enter your gateway info here.';

        // Selected gateway's description as plain text (line breaks kept).
        function gatewayPlaceholder() {
            var id = $('.gateway').find(':selected').data('id');
            var $src = id ? $('.gateway-' + id) : $();
            if (!$src.length) return defaultGatewayPlaceholder;
            var html = $src.html().replace(/<br\s*\/?>/gi, '\n').replace(/<\/(p|div|li)>/gi, '\n');
            var text = $.trim($('<div>').html(html).text().replace(/\n{3,}/g, '\n\n'));
            return text || defaultGatewayPlaceholder;
        }

        // TinyMCE shows its placeholder only while the editor is empty, by putting the text in
        // the body's data-mce-placeholder attribute (and removing it once there is content).
        // So: swap the text only when that attribute is present, never add it ourselves.
        function setEditorPlaceholder(editor, text) {
            var body = editor && editor.getBody();
            if (body && body.hasAttribute('data-mce-placeholder')) {
                body.setAttribute('data-mce-placeholder', text);
                body.setAttribute('aria-placeholder', text);
            }
        }

        function updateGatewayPlaceholder() {
            var text = gatewayPlaceholder();
            $('#gateway_information').attr('placeholder', text); // fallback if the editor fails to load
            setEditorPlaceholder(window.tinymce && tinymce.get('gateway_information'), text);
        }

        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '.editor',

                base_url: '/admin/assets/dist/libs/tinymce',
                suffix: '.min',

                plugins: 'advlist autolink lists link image charmap preview ' +
                    'anchor searchreplace visualblocks code fullscreen ' +
                    'insertdatetime media table help wordcount',

                link_default_protocol: 'https',
                convert_urls: false,
                promotion: false, // hide TinyMCE's "Upgrade" button

                placeholder: gatewayPlaceholder(),
                // Multi-line placeholder, in a softer colour
                content_style: '.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {' +
                    ' white-space: pre-line; color: rgba(34, 47, 62, .5); line-height: 1.6; }',

                setup: function(editor) {
                    // When the editor becomes empty again, show the CURRENT gateway's text
                    // (TinyMCE would otherwise reuse the text it started with).
                    editor.on('PlaceholderToggle', function(e) {
                        if (e.state) setEditorPlaceholder(editor, gatewayPlaceholder());
                    });
                },
                init_instance_callback: updateGatewayPlaceholder
            });
        });

        $(document).on('change', '.gateway', updateGatewayPlaceholder);

        $(document).ready(function() {
            $('select').niceSelect();
            updateGatewayPlaceholder();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#profileForm');
            if (!form) return;

            form.addEventListener('submit', function() {
                const editor = window.tinymce && tinymce.get('gateway_information');
                if (!editor) return; // plain textarea fallback submits as-is

                let content = editor.getContent({ format: 'html' });

                // convert ONLY plain URLs (not already linked)
                content = content.replace(
                    /(^|[\s>])((https?:\/\/)[^\s<]+)/g,
                    function(match, prefix, url) {
                        return prefix + '<a href="' + url + '" target="_blank" rel="noopener">' + url + '</a>';
                    }
                );

                editor.setContent(content);
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
