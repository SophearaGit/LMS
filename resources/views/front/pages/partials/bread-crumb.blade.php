<section class="wsus__breadcrumb"
    @if (config('settings.site_breadcrumb')) style="background: url({{ asset(config('settings.site_breadcrumb')) }})"
@else
    style="background: url({{ asset('/front/images/breadcrumb_bg.jpg') }})" @endif>
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__breadcrumb_text">
                        <h1>
                            @if (Route::is('courses'))
                                Courses
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
                            @elseif (Route::is('blog.index'))
                                Blogs
                            @elseif (Route::is('blog.detail'))
                                Blog details
                            @endif
                        </h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                @if (Route::is('courses'))
                                    Courses
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
                                @elseif (Route::is('blog.index'))
                                    Blogs
                                @elseif (Route::is('blog.detail'))
                                    Blog details
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
