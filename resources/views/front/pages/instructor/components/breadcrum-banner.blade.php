<section class="wsus__breadcrumb" style="background: url({{ asset('/front/images/breadcrumb_bg.jpg') }});">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__breadcrumb_text">
                        <h1>
                            @if (Route::is('instructor.orders.invoice'))
                                Invoice
                            @elseif(Route::is('instructor.orders.index'))
                                Orders
                            @elseif (Route::is('instructor.courses.index'))
                                Courses
                            @endif
                        </h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                @if (Route::is('instructor.orders.invoice'))
                                    Invoice
                                @elseif(Route::is('instructor.orders.index'))
                                    Orders
                                @elseif (Route::is('instructor.courses.index'))
                                    Courses
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
