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
                        <h3 class="card-title">Payment Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a href="#paypal-settings" class="nav-link " data-bs-toggle="tab"
                                            aria-selected="true" role="tab">
                                            <i class="ti ti-brand-paypal mb-1"></i>&nbsp; Paypal Settings
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#stripe-settings" class="nav-link " data-bs-toggle="tab"
                                            aria-selected="false" tabindex="-1" role="tab">
                                            <i class="ti ti-brand-stripe mb-1"></i>&nbsp; Stripe Settings
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="#razorpay-settings" class="nav-link active" data-bs-toggle="tab"
                                            aria-selected="false" tabindex="-1" role="tab">
                                            <i class="ti ti-blade mb-1"></i>&nbsp; Razorpay Settings
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane " id="paypal-settings" role="tabpanel">
                                        <form action="{{ route('admin.payment-settings.paypal') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Mode</label>
                                                        <select class="form-select" name="paypal_mode">
                                                            <option @selected(config('gateway_setting.paypal_mode') === 'sandbox') value="sandbox">
                                                                Sandbox
                                                            </option>
                                                            <option @selected(config('gateway_setting.paypal_mode') === 'live') value="live">
                                                                Live
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('paypal_mode')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Currency</label>
                                                        <select class="form-select select2" name="paypal_currency">
                                                            <option value="">Please Select</option>
                                                            @foreach (config('gateway_currencies.paypal_currencies') as $key => $value)
                                                                <option @selected(config('gateway_setting.paypal_currency') === $value['code'])
                                                                    value="{{ $value['code'] }}">
                                                                    {{ $value['code'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Rate (USD)</label>
                                                        <input type="text" class="form-control" name="paypal_rate"
                                                            placeholder="Enter Paypal Rate Here."
                                                            value="{{ config('gateway_setting.paypal_rate') }}">
                                                        <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Client ID</label>
                                                        <input type="text" class="form-control"
                                                            name="paypal_live_client_id"
                                                            placeholder="Enter Paypal Live Client ID Here."
                                                            value="{{ config('gateway_setting.paypal_live_client_id') }}">
                                                        <x-input-error :messages="$errors->get('paypal_live_client_id')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Client Secret</label>
                                                        <input type="text" class="form-control"
                                                            name="paypal_live_client_secret"
                                                            placeholder="Enter Paypal Live Client Secret Here."
                                                            value="{{ config('gateway_setting.paypal_live_client_secret') }}">
                                                        <x-input-error :messages="$errors->get('paypal_live_client_secret')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-4">
                                                        <label class="form-label">App ID</label>
                                                        <input type="text" class="form-control" name="paypal_live_app_id"
                                                            placeholder="Enter Paypal Live App ID Here."
                                                            value="{{ config('gateway_setting.paypal_live_app_id') }}">
                                                        <x-input-error :messages="$errors->get('paypal_live_app_id')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="ti ti-download mb-2"></i>&nbsp;Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane " id="stripe-settings" role="tabpanel">
                                        <form action="{{ route('admin.payment-settings.stripe') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Stripe Status
                                                        </label>
                                                        <select class="form-select" name="stripe_status">
                                                            <option @selected(config('gateway_setting.stripe_status') === 'active') value="active">
                                                                Active
                                                            </option>
                                                            <option @selected(config('gateway_setting.stripe_status') === 'inactive') value="inactive">
                                                                Inactive
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Currency</label>
                                                        <select class="form-select select2" name="stripe_currency">
                                                            <option value="">Please Select</option>
                                                            @foreach (config('gateway_currencies.stripe_currencies') as $key => $value)
                                                                <option @selected(config('gateway_setting.stripe_currency') === $value)
                                                                    value="{{ $value }}">
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('stripe_currency')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Rate (USD)</label>
                                                        <input type="text" class="form-control" name="stripe_rate"
                                                            placeholder="Enter Stripe Rate Here."
                                                            value="{{ config('gateway_setting.stripe_rate') }}">
                                                        <x-input-error :messages="$errors->get('stripe_rate')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Publishable Key</label>
                                                        <input type="text" class="form-control"
                                                            name="stripe_publishable_key"
                                                            placeholder="Enter Stripe Publishable Key Here."
                                                            value="{{ config('gateway_setting.stripe_publishable_key') }}">
                                                        <x-input-error :messages="$errors->get('stripe_publishable_key')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Secret Key</label>
                                                        <input type="text" class="form-control"
                                                            name="stripe_secret_key"
                                                            placeholder="Enter Stripe Secret Key Here."
                                                            value="{{ config('gateway_setting.stripe_secret_key') }}">
                                                        <x-input-error :messages="$errors->get('stripe_secret_key')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="ti ti-download mb-2"></i>&nbsp;Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane active show" id="razorpay-settings" role="tabpanel">
                                        <form action="{{ route('admin.payment-settings.razorpay') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Razorpay Status
                                                        </label>
                                                        <select class="form-select" name="razorpay_status">
                                                            <option @selected(config('gateway_setting.razorpay_status') === 'active') value="active">
                                                                Active
                                                            </option>
                                                            <option @selected(config('gateway_setting.razorpay_status') === 'inactive') value="inactive">
                                                                Inactive
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('razorpay_status')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Currency</label>
                                                        <select class="form-select select2" name="razorpay_currency">
                                                            <option value="">Please Select</option>
                                                            @foreach (config('gateway_currencies.razorpay_currencies') as $key => $value)
                                                                <option @selected(config('gateway_setting.razorpay_currency') === $value)
                                                                    value="{{ $value }}">
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('razorpay_currency')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Rate (USD)</label>
                                                        <input type="text" class="form-control" name="razorpay_rate"
                                                            placeholder="Enter Razorpay Rate Here."
                                                            value="{{ config('gateway_setting.razorpay_rate') }}">
                                                        <x-input-error :messages="$errors->get('razorpay_rate')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Key ID</label>
                                                        <input type="text" class="form-control" name="razorpay_key_id"
                                                            placeholder="Enter Razorpay Key ID Here."
                                                            value="{{ config('gateway_setting.razorpay_key_id') }}">
                                                        <x-input-error :messages="$errors->get('razorpay_key_id')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Key Secret</label>
                                                        <input type="text" class="form-control"
                                                            name="razorpay_key_secret"
                                                            placeholder="Enter Razorpay Key Secret Here."
                                                            value="{{ config('gateway_setting.razorpay_key_secret') }}">
                                                        <x-input-error :messages="$errors->get('razorpay_key_secret')" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-end">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="ti ti-download mb-2"></i>&nbsp;Save
                                                        </button>
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
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/admin/assets/dist/libs/tom-select/dist/js/tom-select.base.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
