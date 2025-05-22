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

    <section class="wsus__breadcrumb" style="background: url(/front//front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>instructor Profile</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>instructor Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.instructor.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dashboard_contant">
                                <div class="wsus__dashboard_contant_top">
                                    <div class="wsus__dashboard_heading">
                                        <h5>Orders</h5>
                                        <p>View and manage your course orders and sales details here.</p>
                                    </div>
                                </div>

                                <div class="wsus__dash_order_table">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th class="details">
                                                                COURSE NAME
                                                            </th>
                                                            <th class="sale">
                                                                PURCHASE BY
                                                            </th>
                                                            <th class="invoice">
                                                                PRICE
                                                            </th>
                                                            <th class="date">
                                                                COMMISSION
                                                            </th>
                                                            <th class="method">
                                                                EARNING
                                                            </th>
                                                            <th class="icon">

                                                            </th>
                                                        </tr>
                                                        @forelse ($orderItems as $orderItem)
                                                            <tr>
                                                                <td class="details">
                                                                    <p class="rating">
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        <i class="fas fa-star" aria-hidden="true"></i>
                                                                        <i class="fas fa-star-half-alt"
                                                                            aria-hidden="true"></i>
                                                                        <i class="far fa-star" aria-hidden="true"></i>
                                                                        <span>(5.0)</span>
                                                                    </p>
                                                                    <a class="title"
                                                                        href="{{ route('courses.show', $orderItem->course->slug) }}">{{ $orderItem->course->title }}</a>

                                                                </td>
                                                                <td class="sale">
                                                                    <p>{{ $orderItem->order->customer->name }}</p>
                                                                </td>
                                                                <td class="invoice">
                                                                    <p>{{ $orderItem->price }}$</p>
                                                                </td>
                                                                <td class="date">
                                                                    <p>{{ $orderItem->commission_rate ?? 0 }}%</p>
                                                                </td>
                                                                <td class="method">
                                                                    <p>
                                                                        {{ calculateCommission($orderItem->price, $orderItem->commission_rate) }} {{ $orderItem->order->currency }}
                                                                    </p>
                                                                </td>
                                                                <td class="icon">
                                                                    <a href="dashboard_invoice.html">
                                                                        <img src="/front/images/eye.png" alt="eye"
                                                                            class="img-fluid w-100">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
@endpush
