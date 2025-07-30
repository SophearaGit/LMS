@extends('admin.layouts.master')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
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
    <div class="container-xl">
        <div class="card mt-3">
            <div class="row g-0">
                <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-9=12 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">My Account</h2>
                            <h3 class="card-title">Profile Image</h3>
                            <div class="row align-items-center">
                                <div class="col-auto"><span class="avatar avatar-xl"
                                        style="background-image: url({{ asset($personalDetails->image) }})"></span>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn"
                                        onclick="event.preventDefault(); document.getElementById('avatar-upload').click();">
                                        Change avatar
                                    </a>
                                    <input type="file" id="avatar-upload" name="image" style="display: none;"
                                        accept="image/*">
                                    <input type="hidden" name="old_image" value="{{ $personalDetails->image }}">
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Personal Details</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-label">Name</div>
                                    <input type="text" class="form-control" name="name" placeholder="John Doe"
                                        value="{{ $personalDetails->name }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Email</div>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="john.doe@example.com" value="{{ $personalDetails->email }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="col-md-12">
                                    <div class="form-label">Bio</div>
                                    <textarea class="form-control" name="bio" rows="5" placeholder="Tell us about yourself...">{!! $personalDetails->bio !!}</textarea>
                                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="row g-0">
                <form action="{{ route('admin.profile.password.update') }}" method="post">
                    @csrf
                    <div class="col-12 col-md-9=12 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Security update</h2>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-label">Current Password</div>
                                    <input type="password" class="form-control" name="current_password"
                                        placeholder="Enter current password">
                                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">New Password</div>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter new password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Confirm New Password</div>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script>
        const csrf_token = $(`meta[name=csrf_token]`).attr('content');
        var delete_url = null;

        $('.delete-payoutGateway').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            delete_url = url;
            $('#modal-danger').modal('show');
        });

        $('.delete-confirm-btn').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'DELETE',
                url: delete_url,
                data: {
                    _token: csrf_token
                },
                beforeSend: function() {
                    $('.delete-confirm-btn').text('Deleting...');
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    let errMsg = xhr.responseJSON.message;
                    notyf.error(errMsg);
                }
            });
        });
    </script>
@endpush
