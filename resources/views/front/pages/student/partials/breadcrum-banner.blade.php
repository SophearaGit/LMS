<section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="wsus__breadcrumb_text">
                        <h1 class="text-uppercase">
                            @if (Route::is('student.dashboard'))
                                Dashboard
                            @elseif (Route::is('student.profile'))
                                Profile
                            @elseif (Route::is('student.enroll_courses.index'))
                                Enrolled Courses
                            @elseif (Route::is('student.become_instructor'))
                                Become An Instructor
                            @elseif (Route::is('student.orders.index'))
                                Orders
                            @elseif (Route::is('student.reviews.index'))
                                Reviews
                            @endif
                        </h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                @if (Route::is('student.dashboard'))
                                    Dashboard
                                @elseif (Route::is('student.profile'))
                                    Profile
                                @elseif (Route::is('student.enroll_courses.index'))
                                    Enrolled Courses
                                @elseif (Route::is('student.become_instructor'))
                                    Become An Instructor
                                @elseif (Route::is('student.orders.index'))
                                    Orders
                                @elseif (Route::is('student.reviews.index'))
                                    Reviews
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
