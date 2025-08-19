@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.student.partials.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
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
                                                    <th class="price">
                                                        Price
                                                    </th>
                                                    <th class="quantity">
                                                        Quantity
                                                    </th>
                                                    <th class="total">
                                                        Total
                                                    </th>
                                                </tr>
                                                @forelse ($order->order_items as $item)
                                                    <tr>
                                                        <td class="serial">
                                                            <p>{{ $loop->iteration }}</p>
                                                        </td>
                                                        <td class="description">
                                                            <p>{{ $item->course->title }}</p>
                                                        </td>
                                                        <td class="price">
                                                            <p>{{ config('settings.site_currency_icon') }}{{ $item->price }}
                                                            </p>
                                                        </td>
                                                        <td class="quantity">
                                                            <p>{{ $item->qty }}</p>
                                                        </td>
                                                        <td class="total">
                                                            <p>{{ config('settings.site_currency_icon') }}{{ $item->price }}
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
                                            {{ config('settings.site_currency_icon') }}{{ $order->total_amount }}
                                        </span></h6>
                                        <h5>Paid amount: <span>
                                            {{ config('settings.site_currency_icon') }}{{ $order->total_amount }}
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
