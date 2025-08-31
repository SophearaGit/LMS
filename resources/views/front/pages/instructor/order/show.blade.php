@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.instructor.components.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.instructor.components.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__invoice_top">
                            <div class="wsus__invoice_logo">
                                <img src="{{ asset('/front/images/logo.png') }}" alt="logo" class="img-fluid w-100">
                            </div>
                            <div class="wsus__invoice_heading">
                                <h2>INVOICE</h2>
                            </div>
                        </div>
                        <div class="wsus__invoice_description">
                            <h4>Invoice to:</h4>
                            <div class="row justify-content-between">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="wsus__invoice_address">
                                        <h5>Cambodia</h5>
                                        <p>7232 Broadway Suite 3087 Madison Heights, 57256</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-5">
                                    <div class="wsus__invoice_date">
                                        <h5>Invoice#<span>{{ $order->invoice_id }}</span></h5>
                                        <h5 class="date">
                                            Date<span>{{ \Carbon\Carbon::parse($order->created_at)->format('m / d / Y') }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="serial">
                                                        NO.
                                                    </th>
                                                    <th class="description">
                                                        COURSE
                                                    </th>
                                                    <th class="description">
                                                        PURCHASE BY
                                                    </th>
                                                    <th class="price">
                                                        PRICE
                                                    </th>
                                                    <th class="total">
                                                        COMMISSION
                                                    </th>
                                                    <th class="total">
                                                        EARNING
                                                    </th>
                                                </tr>
                                                @php
                                                    $urlItemId = (int) request()->route('orderItem');
                                                @endphp
                                                @forelse ($order->order_items as $item)
                                                    <tr>
                                                        <td
                                                            class="serial {{ $item->id === $urlItemId ? 'bg-info bg-opacity-25' : '' }} ">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ $loop->iteration }}</p>
                                                        </td>
                                                        <td
                                                            class="description {{ $item->id === $urlItemId ? 'bg-info  bg-opacity-25' : '' }}">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ $item->course->title }}</p>
                                                        </td>
                                                        <td
                                                            class="description {{ $item->id === $urlItemId ? 'bg-info  bg-opacity-25' : '' }}">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ $order->customer->name }}</p>
                                                        </td>
                                                        <td
                                                            class="price {{ $item->id === $urlItemId ? 'bg-info  bg-opacity-25' : '' }}">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ config('settings.site_currency_icon') }}{{ $item->price }}
                                                            </p>
                                                        </td>
                                                        <td
                                                            class="total {{ $item->id === $urlItemId ? 'bg-info bg-opacity-25' : '' }}">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ $item->commission_rate ?? 0 }}%</p>
                                                        </td>
                                                        <td
                                                            class="total {{ $item->id === $urlItemId ? 'bg-info  bg-opacity-25' : '' }}">
                                                            <p class="{{ $item->id === $urlItemId ? 'text-dark' : '' }}">
                                                                {{ config('settings.site_currency_icon') }}{{ number_format(calculateCommission($item->price, $item->commission_rate), 2) }}
                                                            </p>
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
                        <div class="wsus__invoice_final_total">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__invoice_final_total_left">
                                        <p>Thank you for your business</p>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__invoice_final_total_right">
                                        <h6>Subtotal:<span>
                                                {{ config('settings.site_currency_icon') }}
                                                {{ number_format(
                                                    $order->order_items->sum(function ($item) {
                                                        return calculateCommission($item->price, $item->commission_rate);
                                                    }),
                                                    2,
                                                ) }}
                                            </span></h6>
                                        <h5>Earning amount: <span>
                                                {{ config('settings.site_currency_icon') }}
                                                {{ number_format(
                                                    $order->order_items->sum(function ($item) {
                                                        return calculateCommission($item->price, $item->commission_rate);
                                                    }),
                                                    2,
                                                ) }}
                                            </span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_bottom">
                            <p>{{ config('settings.site_address') }} <span>{{ config('settings.site_phone') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
