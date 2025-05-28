@extends('front.layouts.auth-page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'CAITD | Sign In')
@push('stylesheets')
    <style>
        .wsus__sign_in {
            margin-top: 95px;
        }
    </style>
@endpush
@section('content')
    <section class="wsus__sign_in">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="/front/images/login_img_1.jpg" alt="login" class="img-fluid">
                    <a href="index.html">
                        <img src="/front/images/logo.png" alt="CAITD" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h2>Log In<span>!</span></h2>
                                <p class="new_user mt-4">New user ? <a href="{{ route('register') }}">Create an Account</a>
                                </p>
                                <div class="row">
                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                                placeholder="Enter your email here." autofocus autocomplete="username" required>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">
                                                        {{ __('Forgot your password?') }}
                                                    </a>
                                                @endif
                                            </label>
                                            <input name="password" id="password" type="password" placeholder="Enter your password here."
                                                autocomplete="current-password" required>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                    <!-- Remember Me -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <div class="form-check">
                                                <input id="remember_me" name="remember_me" class="form-check-input"
                                                    type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ __('Remember me') }}
                                                </label>
                                            </div>
                                            <button type="submit" class="common_btn">Sign In</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="or">or</p>
                            <ul class="social_login d-flex flex-wrap">
                                <li>
                                    <a href="javascript:;">
                                        <span><img src="/front/images/google_icon.png" alt="Google"
                                                class="img-fluid"></span>
                                        Google
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="back_btn" href="{{ route('home') }}">Back to Home</a>
    </section>
@endsection
