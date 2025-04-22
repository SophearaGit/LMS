<div class="col-xl-3 col-md-4 wow fadeInLeft">
    <div class="wsus__dashboard_sidebar">
        <div class="wsus__dashboard_sidebar_top">
            <div class="dashboard_banner">
                <img src="/front/images/single_topic_sidebar_banner.jpg" alt="img" class="img-fluid">
            </div>
            <div class="img">
                <img src="{{ auth()->user()->image }}" alt="profile" class="img-fluid w-100">
            </div>
            <h4>{{ auth()->user()->name }}</h4>
            <p><strong>{{ auth()->user()->role }}</strong></p>
        </div>
        <ul class="wsus__dashboard_sidebar_menu">
            <li>
                <a href="{{ route('instructor.dashboard') }}"
                    class="{{ Route::is('instructor.dashboard') ? 'active' : '' }}">
                    <div class="img">
                        <img src="/front/images/dash_icon_8.png" alt="icon" class="img-fluid w-100">
                    </div>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.profile') }}"
                    class="{{ Route::is('instructor.profile') ? 'active' : '' }}">
                    <div class="img">
                        <img src="/front/images/dash_icon_1.png" alt="icon" class="img-fluid w-100">
                    </div>
                    Profile
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.courses.index') }}"
                    class="{{ Route::is('instructor.courses.index') || Route::is('instructor.courses.create') ? 'active' : '' }}">
                    <div class="img">
                        <img src="/front/images/dash_icon_2.png" alt="icon" class="img-fluid w-100">
                    </div>
                    Courses
                </a>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" class="logoutForm">
                    @csrf
                </form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();$('.logoutForm').submit();">
                    <div class="img">
                        <img src="/front/images/dash_icon_16.png" alt="icon" class="img-fluid w-100">
                    </div>
                    {{ __('Log Out') }}
                </a>
            </li>
        </ul>
    </div>
</div>
