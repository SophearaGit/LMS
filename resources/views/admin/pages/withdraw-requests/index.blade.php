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
    <div class="container-xl mt-4">
        <div class="row row-cards">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Withdraw Requests</h3>
                    </div>
                    <div class="card-body">
                        {{-- TABLE START --}}
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdrawRequests as $withdrawRequest)
                                        <tr>
                                            <td>
                                                {{ $withdrawRequest->instructor->name }}
                                            </td>
                                            <td>
                                                {{ config('settings.site_currency_icon') }}{{ $withdrawRequest->amount }}
                                            </td>
                                            <td>
                                                @if ($withdrawRequest->status === 'pending')
                                                    <span class="badge bg-yellow-lt text-capitalize">
                                                        {{ $withdrawRequest->status }}
                                                    </span>
                                                @elseif($withdrawRequest->status === 'approved')
                                                    <span class="badge bg-green-lt text-capitalize">
                                                        {{ $withdrawRequest->status }}
                                                    </span>
                                                @elseif($withdrawRequest->status === 'rejected')
                                                    <span class="badge bg-red-lt text-capitalize">
                                                        {{ $withdrawRequest->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.withdraw-request.show', $withdrawRequest->id) }}"
                                                    class="text-primary">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- TABLE END --}}
                        <div class="mt-4">
                            {{ $withdrawRequests->links() }}
                        </div>
                    </div>
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
