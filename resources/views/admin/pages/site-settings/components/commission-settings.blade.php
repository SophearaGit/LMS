@extends('admin.pages.site-settings.index-layout')
@section('settings-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.site-settings.update-commission-settings') }}" method="POST">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">Commission Settings</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Instructor Commission Rate Per Sale (%)</div>
                        <input type="number" step="0.01" min="0" class="form-control" placeholder="Enter commission percentage" name="commission"
                            value="{{ config('settings.commission') }}">
                        <x-input-error :messages="$errors->get('commission')" class="mt-2"></x-input-error>
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
