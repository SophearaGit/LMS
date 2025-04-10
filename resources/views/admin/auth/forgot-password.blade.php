@extends('admin.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin | Forgot-Password')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="/admin/assets/static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <form method="POST" action="{{ route('admin.password.email') }}" class="card card-md" autocomplete="off"
            novalidate="">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Forgot password</h2>
                <p class="text-secondary mb-4">
                    @if (empty(session('status')))
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    @endif
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                </p>
                <!-- Email Address -->
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email"
                        value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                            </path>
                            <path d="M3 7l9 6l9 -6"></path>
                        </svg>
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            Forget it, <a href="{{ route('admin.login') }}">send me back</a> to the sign in screen.
        </div>
    </div>
@endsection
