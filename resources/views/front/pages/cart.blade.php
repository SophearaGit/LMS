@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
        @if (count($cart) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="cart_list">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="pro_img">Product</th>

                                            <th class="pro_name"></th>

                                            <th class="pro_tk">Price</th>

                                            <th class="pro_icon">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart as $item)
                                            <tr>
                                                <td class="pro_img">
                                                    <img src="{{ $item->course->thumbnail }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>

                                                <td class="pro_name">
                                                    <a
                                                        href="{{ route('courses.show', $item->course->slug) }}">{{ $item->course->title }}</a>
                                                </td>
                                                <td class="pro_tk">
                                                    <h6>
                                                        @if ($item->course->discount > 0)
                                                            <del>${{ number_format($item->course->price, 2) }}</del>
                                                            ${{ number_format($item->course->price - ($item->course->price * $item->course->discount) / 100, 2) }}
                                                        @else
                                                            ${{ number_format($item->course->price, 2) }}
                                                        @endif
                                                    </h6>
                                                </td>

                                                <td class="pro_icon">
                                                    <a href="{{ route('cart.destroy', $item->id) }}"><i class="fal fa-times"
                                                            aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <h6>No items in cart</h6>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="continue_shopping">
                            <a href="{{ route('courses') }}" class="common_btn">continue shopping</a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-7 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="total_price">
                            <div class="subtotal_area">
                                <h5>Subtotal<span>${{ cartTotalPrice() }}</span></h5>
                                <a href="{{ url('/checkout') }}" class="common_btn">proceed checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <span style="font-size: 250px">🥲👉🛒</span>
                        <h3 class="mb-3">Your cart is empty</h3>
                        <p class="mb-3">Looks like you haven't added anything to your cart yet.</p>
                        <a href="{{ route('courses') }}" class="common_btn">Go Buy Course</a>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
