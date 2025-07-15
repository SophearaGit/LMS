<section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__breadcrumb_text">
                        <h1>
                            @if (Route::is('courses'))
                                Our Courses
                            @elseif (Route::is('cart.index'))
                                Shopping Cart
                            @elseif (Route::is('checkout.index'))
                                Checkout
                            @elseif (Route::is('order.success'))
                                Payment Success!
                            @elseif (Route::is('order.fail'))
                                Payment Cancelled!
                            @elseif (Route::is('home.about'))
                                How We Work
                            @elseif (Route::is('home.contact_us'))
                                Contact Us
                            @endif
                        </h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                @if (Route::is('courses'))
                                    Our Courses
                                @elseif (Route::is('cart.index'))
                                    Shopping Cart
                                @elseif (Route::is('checkout.index'))
                                    Checkout
                                @elseif (Route::is('order.success'))
                                    Payment Success!
                                @elseif (Route::is('order.fail'))
                                    Payment Cancelled!
                                @elseif (Route::is('home.about'))
                                    About Us
                                @elseif (Route::is('home.contact_us'))
                                    Contact Us
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
