<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex mx-3">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-moon"></i>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-sun"></i>
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset(auth()->guard('admin')->user()->image) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->guard('admin')->user()->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.site-settings.index') }}" class="dropdown-item">Settings</a>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();getElementById('logout').submit();"
                        class="dropdown-item">Logout</a>
                    <form method="POST" id="logout" action="{{ route('admin.logout') }}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            {{-- Add on anthing in here --}}
        </div>
    </div>
</header>
