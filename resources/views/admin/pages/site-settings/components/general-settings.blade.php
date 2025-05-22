@extends('admin.pages.site-settings.index-layout')
@section('settings-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.site-settings.update-general-settings') }}" method="POST">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">General Settings</h3>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-label">Site Name</div>
                        <input type="text" class="form-control" placeholder="Enter site name here." name="site_name"
                            value="{{ config('settings.site_name') }}">
                        <x-input-error :messages="$errors->get('site_name')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Phone Number</div>
                        <input type="text" class="form-control" placeholder="Enter site tel here." name="site_phone"
                            value="{{ config('settings.site_phone') }}">
                        <x-input-error :messages="$errors->get('site_phone')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Address</div>
                        <input type="text" class="form-control" placeholder="Enter site address here."
                            name="site_address" value="{{ config('settings.site_address') }}">
                        <x-input-error :messages="$errors->get('site_address')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Default Currency</div>
                        <select class="form-select select2" name="site_currency">
                            <option value="">Select default currency</option>
                            @foreach (config('gateway_currencies.all_currencies') as $key => $value)
                                <option @selected(config('settings.site_currency') === $value) value="{{ $value }}">{{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('site_currency')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Default Currency Icon</div>
                        <input type="text" class="form-control" placeholder="Enter site default currency icon here."
                            name="site_currency_icon" value="{{ config('settings.site_currency_icon') }}">
                        <x-input-error :messages="$errors->get('site_currency_icon')" class="mt-2"></x-input-error>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
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
