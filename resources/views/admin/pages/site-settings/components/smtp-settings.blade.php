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

                    <div class="col-md-6">
                        <div class="form-label">Mail Mailer</div>
                        <input type="text" class="form-control" placeholder="smtp" name="mail_mailer"
                            value="{{ config('settings.mail_mailer') }}">
                        <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2"></x-input-error>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Mail Host</div>
                        <input type="text" class="form-control" placeholder="sandbox.smtp.mailtrap.io" name="mail_host"
                            value="{{ config('settings.mail_host') }}">
                        <x-input-error :messages="$errors->get('mail_host')" class="mt-2"></x-input-error>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Mail Port</div>
                        <input type="number" class="form-control" placeholder="2525" name="mail_port"
                            value="{{ config('settings.mail_port') }}">
                        <x-input-error :messages="$errors->get('mail_port')" class="mt-2"></x-input-error>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Mail Username</div>
                        <input type="text" class="form-control" placeholder="d850325555ef2a" name="mail_username"
                            value="{{ config('settings.mail_username') }}">
                        <x-input-error :messages="$errors->get('mail_username')" class="mt-2"></x-input-error>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label">Mail Password</div>
                        <input type="password" class="form-control" placeholder="8ad9a49e6ca83b" name="mail_password"
                            value="{{ config('settings.mail_password') }}">
                        <x-input-error :messages="$errors->get('mail_password')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label">Mail Encryption</div>
                        <input type="text" class="form-control" placeholder="tls" name="mail_encryption"
                            value="{{ config('settings.mail_encryption') }}">
                        <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2"></x-input-error>
                    </div>
                    <div class="col-md-12">
                        <div class="form-label">Mail Queue</div>
                        <select class="form-select" name="mail_queue">
                            <option value="true" @selected(config('settings.mail_queue') == 'true')>ON</option>
                            <option value="false" @selected(config('settings.mail_queue') == 'false')>OFF</option>
                        </select>
                        <x-input-error :messages="$errors->get('mail_queue')" class="mt-2"></x-input-error>
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
