@extends('admin.pages.site-settings.index-layout')
@section('settings-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.site-settings.update-smtp-settings') }}" method="POST">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">SMTP Settings</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Sender Email</div>
                        <input type="email" class="form-control" placeholder="Enter sender email here." name="sender_email"
                            value="{{ config('settings.sender_email') }}">
                        <x-input-error :messages="$errors->get('sender_email')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Receiver Email</div>
                        <input type="email" class="form-control" placeholder="Enter receiver email here."
                            name="receiver_email" value="{{ config('settings.receiver_email') }}">
                        <x-input-error :messages="$errors->get('receiver_email')" class="mt-2"></x-input-error>
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
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
