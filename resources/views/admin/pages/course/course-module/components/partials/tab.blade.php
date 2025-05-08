<ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link course-tab {{ request()->step == 1 || Route::is('admin.courses.create') ? 'active' : '' }} "
            data-step="1" href="">Basic
            Infos</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link course-tab {{ request()->step == 2 ? 'active' : '' }}" data-step="2" href="">More
            Infos</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link course-tab {{ request()->step == 3 ? 'active' : '' }} " data-step="3" href="">Course
            Contents</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link course-tab {{ request()->step == 4 ? 'active' : '' }} " data-step="4"
            href="">Finish</a>
    </li>
</ul>
