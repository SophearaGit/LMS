<nav class="navbar navbar-expand-lg main_menu main_menu_3">
    <a class="navbar-brand" href="index_3.html">
        <img src="/front/images/logo.png" alt="CAITD" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home.about') ? 'active' : '' }}" href="{{ route('home.about') }}">About
                    Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('courses') ? 'active' : '' }} "
                    href="{{ route('courses') }}">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home.contact_us') ? 'active' : '' }}"
                    href="{{ route('home.contact_us') }}">Contact
                    Us</a>
            </li>
        </ul>
        <div class="right_menu">
            <div class="menu_search_btn">
                <img src="/front/images/search_icon.png" alt="Search" class="img-fluid">
            </div>
            <ul>
                <li>
                    <a class="menu_signin" href="{{ route('cart.index') }}">
                        <span>
                            <img src="/front/images/cart_icon_black.png" alt="user" class="img-fluid">
                        </span>
                        <b id="cart_count_badge"
                            class="{{ cartTotalCourseCount() > 0 ? '' : 'd-none' }}">{{ cartTotalCourseCount() }}</b>
                    </a>
                </li>
                @auth
                    @if (Auth::user()->role == 'student')
                        <li>
                            <a class="common_btn" href="{{ route('student.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'instructor')
                        <li>
                            <a class="common_btn" href="{{ route('instructor.dashboard') }}">
                                Teacher Dashboard
                            </a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="common_btn" href="{{ route('login') }}">Sign In</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="wsus__menu_3_search_area">
    <form action="#">
        <input type="text" placeholder="Search School, Online.....">
        <button class="common_btn" type="submit">Search</button>
        <span class="close_search"><i class="far fa-times"></i></span>
    </form>
</div>
