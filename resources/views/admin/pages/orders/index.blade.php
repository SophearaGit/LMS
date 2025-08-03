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
                        <h3 class="card-title">Orders</h3>
                    </div>
                    <div class="card-body">
                        {{-- TABLE START --}}
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Currency</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $order->customer->name }} <br>
                                                <small>
                                                    {{ $order->customer->email }}
                                                </small>
                                            </td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->currency }}</td>
                                            <td class="text-capitalize">{{ $order->payment_method }}</td>
                                            <td>
                                                @if ($order->status === 'pending')
                                                    <span class="badge bg-yellow-lt">{{ $order->status }}</span>
                                                @elseif($order->status === 'approved')
                                                    <span class="badge bg-green-lt">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-muted">
                                                    <i class="ti ti-eye text-primary"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No orders found</td>
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
