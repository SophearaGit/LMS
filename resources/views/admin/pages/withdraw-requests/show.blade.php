@php
    $iPI = $instructorPayoutInformation->information ?? 'No payout information available.';
@endphp

@extends('admin.layouts.master')

@section('pageTitle', $pageTitle ?? 'Page Title Here')

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
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Withdraw Details</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-primary">
                                <i class="ti ti-chevrons-left mb-1"></i>&nbsp;
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="height: 600px">
                            <table class="table table-vcenter card-table">
                                <tbody>
                                    <tr>
                                        <td>Instructor</td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2"
                                                    style="background-image: url({{ $withdraw->instructor->image }})"></span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">
                                                        {{ $withdraw->instructor->name }}
                                                    </div>
                                                    <div class="text-secondary">
                                                        <a href="#" class="text-reset">
                                                            {{ $withdraw->instructor->email }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Current Wallet Balance</td>
                                        <td>
                                            {{ config('settings.site_currency_icon') }}
                                            {{ number_format(floor(($withdraw->instructor->wallet ?? 0) * 100) / 100, 2) }}
                                            {{-- {{ $withdraw->instructor->wallet }} --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payout Amount</td>
                                        <td>
                                            {{ config('settings.site_currency_icon') }}
                                            {{-- {{ $withdraw->amount }} --}}
                                            {{ number_format(floor(($withdraw->amount ?? 0) * 100) / 100, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if ($withdraw->status === 'pending')
                                                <span class="badge bg-yellow-lt text-capitalize">
                                                    {{ $withdraw->status }}
                                                </span>
                                            @elseif($withdraw->status === 'rejected')
                                                <span class="badge bg-red-lt text-capitalize">
                                                    {{ $withdraw->status }}
                                                </span>
                                            @else
                                                <span class="badge bg-green-lt text-capitalize">
                                                    {{ $withdraw->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <div class="alert alert-danger">
                                                <strong>Note:</strong> Once you change the status to approved or rejected,
                                                you can't change it again.
                                            </div>
                                            <div>
                                                <form
                                                    action="{{ route('admin.withdraw-request.update-status', $withdraw->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-control">
                                                        <label for="status" class="form-label ">Status</label>
                                                        <select
                                                            class="mb-1 {{ $withdraw->status != 'pending' ? 'disabled' : '' }}"
                                                            name="status">
                                                            <option value="">Select Status</option>
                                                            <option @selected($withdraw->status == 'pending') value="pending">Pending
                                                            </option>
                                                            <option @selected($withdraw->status == 'approved') value="approved">Approve
                                                            </option>
                                                            <option @selected($withdraw->status == 'rejected') value="rejected">Reject
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                        <button type="submit" class="btn btn-primary mt-2"
                                                            {{ $withdraw->status != 'pending' ? 'disabled' : '' }}>
                                                            Update Status
                                                        </button>
                                                        @if ($withdraw->status == 'pending')
                                                            <a type="submit" class="btn btn-success mt-2"
                                                                data-bs-toggle="modal" data-bs-target="#modal-scrollable">
                                                                Pay Now
                                                            </a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payout Information</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{!! $iPI !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/front/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
@endpush
