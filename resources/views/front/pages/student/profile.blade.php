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
    {{-- BREADCRUMB START --}}
    <section class="wsus__breadcrumb" style="background: url(/front//front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Profile</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Student Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- BREADCRUMB END --}}
    {{-- DASHBOARD OVERVIEW START --}}
    <!-- Session Status -->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Update Your Information</h5>
                                        <p class="text-muted">
                                            Make sure your details are current for the best experience.
                                        </p>
                                    </div>
                                    <div class="wsus__dashboard_profile_delete">
                                        <a href="#" class="common_btn">Delete Profile</a>
                                    </div>
                                </div>
                                <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                    <div class="img">
                                        <img src="{{ auth()->user()->image }}" alt="profile" class="img-fluid w-100">
                                        <label for="profile_photo">
                                            <img src="/front/images/dash_camera.png" alt="camera" class="img-fluid w-100">
                                        </label>
                                        <input type="file" id="profile_photo" hidden="">
                                    </div>
                                    <div class="text">
                                        <h6>Your avatar</h6>
                                        <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                    </div>
                                </div>
                                {{-- START UPDATE PROFILE FORM --}}
                                <form action="{{ route('student.prfile.update') }}" method="POST"
                                    class="wsus__dashboard_profile_update">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_info">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter your name here" value="{{ auth()->user()->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_info">
                                                <label>Headline</label>
                                                <input type="text" name="headline" id="headline"
                                                    placeholder="Enter your headline here"
                                                    value="{{ auth()->user()->headline }}">
                                                <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="wsus__dashboard_profile_update_info">
                                                <label>Email</label>
                                                <input type="email" name="email" id="email"
                                                    placeholder="Enter your email here" value="{{ auth()->user()->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="wsus__dashboard_profile_update_info">
                                                <label>Gender</label>
                                                <select class="mt-2" name="gender" id="gender">
                                                    <option data-display="Select your gender here" value="">Nothing
                                                    </option>
                                                    <option @selected(auth()->user()->gender === 'male') value="male">Male</option>
                                                    <option @selected(auth()->user()->gender === 'female') value="female">Female</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_info">
                                                <label>About Me</label>
                                                <textarea rows="7" name="bio" id="bio" placeholder="Your text here">{{ auth()->user()->bio }}</textarea>
                                                </textarea>
                                                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__dashboard_profile_update_btn">
                                                <button type="submit" class="common_btn">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- END UPDATE PROFILE FORM --}}
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Security update</h5>
                                        <p class="text-muted">
                                            For your account’s safety, we recommend updating your password regularly and
                                            avoiding the reuse of old passwords. Your security is important to us.
                                        </p>
                                    </div>
                                </div>
                                <div class="wsus__dashboard_password_change">
                                    <h6>Change Password</h6>
                                    <p>We will email you a confirmation when changing your password, so please expect
                                        that
                                        email
                                        after submitting.</p>
                                    <form action="{{ route('student.profile.update_password') }}" method="POST"
                                        class="wsus__dashboard_profile_update">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="wsus__dashboard_password_change_input">
                                                    <label for="current_password">Current Password</label>
                                                    <input type="password" name="current_password" id="current_password"
                                                        placeholder="Enter Current Password">
                                                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="wsus__dashboard_password_change_input">
                                                    <label for="password">New Password</label>
                                                    <input type="password" name="password" id="password"
                                                        placeholder="Enter New Password" value="">
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__dashboard_password_change_input">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" placeholder="Confirm New Password"
                                                        value="">
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__dashboard_password_change_btn">
                                                    <button type="submit" class="common_btn">Update Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Update Social Profiles</h5>
                                        <p class="text-muted">
                                            Let’s stay connected—add or update your social links!
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ route('student.profile.update_social_link') }}" method="POST"
                                    class="wsus__dashboard_social_profile">
                                    @csrf
                                    <div class="wsus__dashboard_social_profile_input">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" name="facebook" id="facebook"
                                            placeholder="Facebook Profile Name" value="{{ auth()->user()->facebook }}">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    </div>
                                    <div class="wsus__dashboard_social_profile_input">
                                        <label for="x">Twitter</label>
                                        <input type="text" name="x" id="x"
                                            placeholder="Enter your user name" value="{{ auth()->user()->x }}">
                                        <x-input-error :messages="$errors->get('x')" class="mt-2" />
                                    </div>
                                    <div class="wsus__dashboard_social_profile_input">
                                        <label for="linkedin">LinkedIn Profile URL</label>
                                        <input type="text" name="linkedin" id="linkedin"
                                            placeholder="LinkedIn Profile URL" value="{{ auth()->user()->linkedin }}">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                                    </div>
                                    <div class="wsus__dashboard_social_profile_input">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" placeholder="Website URL"
                                            value="{{ auth()->user()->website }}">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                    <div class="wsus__dashboard_social_profile_input">
                                        <label for="github">GitHub</label>
                                        <input type="text" name="github" id="github"
                                            placeholder="GitHub Profile Name" value="{{ auth()->user()->github }}">
                                        <x-input-error :messages="$errors->get('github')" class="mt-2" />
                                    </div>
                                    <div class="wsus__dashboard_social_profile_btn">
                                        <button type="submit" class="common_btn">Update Social Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DASHBOARD OVERVIEW END --}}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
@endpush
