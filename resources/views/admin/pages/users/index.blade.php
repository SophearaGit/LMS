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
                        <h3 class="card-title">
                            Users
                        </h3>
                    </div>
                    {{-- @include('admin.pages.partials.breadcrumb') --}}
                    <div class="card-body">
                        {{-- TABLE START --}}
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>
                                            image
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url({{ $user->image == '/default-images/avatar/teacher.jpg' || $user->image == '/default-images/avatar/student_girl.png' ? asset('/default-images/avatar/both.jpg') : asset($user->image) }})"></span>
                                                </div>
                                            </td>
                                            <td>{{ $user->name }}</td>

                                            <td class="text-secondary"><a href="#"
                                                    class="text-reset">{{ $user->email }}</a></td>
                                            <td class="text-secondary">
                                                {{ ucfirst($user->role) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
