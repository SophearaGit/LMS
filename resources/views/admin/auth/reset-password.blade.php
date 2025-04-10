@extends('admin.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin | Forgot-Password')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="/admin/assets/static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <form method="POST" action="{{ route('admin.password.store') }}" class="card card-md" autocomplete="off"
            novalidate="">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Reset your password as admin.</h2>
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" id="email"
                        value="{{ old('email', $request->email) }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control password" placeholder="Password" autocomplete="off"
                            name="password" id="password" required aria-autocomplete="new-password">
                        <span class="input-group-text toggle-password">
                            <a href="javascript:;" class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password"
                                data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                    </path>
                                </svg>
                            </a>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control cf_password" placeholder="Confirm Password"
                            autocomplete="off" name="password_confirmation" id="password_confirmation" required
                            aria-autocomplete="new-password">
                        <span class="input-group-text toggle-cfPassword">
                            <a href="javascript:;" class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password"
                                data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                    </path>
                                </svg>
                            </a>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            Already have account? <a href="{{ route('admin.login') }}" tabindex="-1">Sign in</a>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        /**
         * ————————————————————————————————————————————————————————————————————————————————
         * FOR PASSWORD CHANGING TYPE WHEN CLICK
         * ————————————————————————————————————————————————————————————————————————————————
         */
        $('.toggle-password').on('click', function() {
            let iPassword = $('.password')
            if (iPassword.attr('type') === 'password') {
                iPassword.attr('type', 'text')
            } else {
                iPassword.attr('type', 'password')
            }
        })
        /**
         * ————————————————————————————————————————————————————————————————————————————————
         * FOR PASSWORD CONFIRMATION CHANGING TYPE WHEN CLICK
         * ————————————————————————————————————————————————————————————————————————————————
         */
        $('.toggle-cfPassword').on('click', function() {
            let iConfirmPassword = $('.cf_password')
            if (iConfirmPassword.attr('type') === 'password') {
                iConfirmPassword.attr('type', 'text')
            } else {
                iConfirmPassword.attr('type', 'password')
            }
        })
    </script>
@endpush
