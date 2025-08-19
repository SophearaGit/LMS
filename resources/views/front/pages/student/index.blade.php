@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.student.partials.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div
                                class="wsus__dash_earning d-flex align-items-center flex-wrap
                                @if (auth()->user()->approval_status === 'pending') justify-content-between
                                @else justify-content-end @endif">
                                @if (auth()->user()->approval_status === 'pending')
                                    <div class="alert alert-primary m-0  col-8" role="alert">
                                        Your request to become an instructor has been submitted and is currently under
                                        review. <br> We'll notify you once it's approved!
                                    </div>
                                @endif
                                <div class="col-3">
                                    <a href="{{ route('student.become_instructor') }}" class="common_btn">
                                        Become An Instructor?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color:#e6eef6;">
                                <h6><span class="fw-semibold" style="color: #0054a6;">Enrolled Courses</span>
                                    <small>Count</small>
                                </h6>
                                <h3>
                                    {{ $enrolledCoursesCount }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color:#e6eef6;">
                                <h6><span class="fw-semibold" style="color: #0054a6;">Reviews</span>
                                    <small>Count</small>
                                </h6>
                                <h3>
                                    {{ $reviewsCount }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning" style="background-color:#e6eef6;">
                                <h6><span class="fw-semibold" style="color: #0054a6;">Orders</span>
                                    <small>Count</small>
                                </h6>
                                <h3>
                                    {{ $ordersCount }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top">
                                    <div class="wsus__dashboard_heading wow fadeInUp"
                                        style="visibility: visible; animation-name: fadeInUp;">
                                        <h5>Orders</h5>
                                        <p>
                                            Manage your orders and their details like invoice, status, and action.
                                        </p>
                                    </div>
                                </div>
                                <div class="wsus__dash_course_table wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th class="no.">
                                                                No.
                                                            </th>
                                                            <th class="invoice">
                                                                INVOICE
                                                            </th>
                                                            <th class="amount">
                                                                Amount
                                                            </th>
                                                            <th class="date">
                                                                DATE
                                                            </th>
                                                            <th class="method">
                                                                METHOD
                                                            </th>
                                                            <th class="status">
                                                                STATUS
                                                            </th>
                                                            <th class="icon">

                                                            </th>
                                                        </tr>
                                                        @forelse ($orders as $order)
                                                            <tr>
                                                                <td class="no.">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="invoice">
                                                                    #{{ $order->invoice_id }}
                                                                </td>
                                                                <td class="amount">
                                                                    {{ $order->total_amount }} {{ $order->currency }}
                                                                </td>
                                                                <td class="date">
                                                                    {{ \Carbon\Carbon::parse($order->created_at)->format('m / d / Y') }}
                                                                </td>
                                                                <td class="method">
                                                                    {{ $order->payment_method }}
                                                                </td>
                                                                <td class="status">
                                                                    @if ($order->status === 'pending')
                                                                        <p class="pending">Pending</p>
                                                                    @elseif($order->status === 'approved')
                                                                        <p class="active">Approved</p>
                                                                    @endif
                                                                </td>
                                                                <td class="icon">
                                                                    <a
                                                                        href="{{ route('student.orders.invoice', $order->id) }}">
                                                                        <img src="{{ asset('/front/images/eye1.png') }}"
                                                                            alt="eye" class="img-fluid"
                                                                            style="width: 50px !important; height: auto !important;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center">
                                                                    <p class="text-muted">No data found.</p>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
