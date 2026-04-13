<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="breadcrumb-item
    active
    " aria-current="page">
        @if (Route::is('admin.instructor-requests.index'))
            Instructor Requests
        @endif
        @if (Route::is('admin.courses.index'))
            Courses
        @endif
    </span>
</nav>
