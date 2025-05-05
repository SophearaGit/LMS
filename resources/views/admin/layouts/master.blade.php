<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="base_url" content="{{ url('/') }}">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <script src="/admin/assets/dist/js/jquery-3.7.1.min.js"></script>
    <link href="/admin/assets/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="/admin/assets/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <link href="/admin/assets/dist/css/nice-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="/vendor/flasher/flasher-notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="/admin/assets/dist/css/jquery-ui.min.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .ti {
            font-size: 20px;
        }
    </style>
    @stack('stylesheets')
</head>

<body>
    <script src="/admin/assets/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <div class="page-wrapper">
            <!-- Page header -->
            {{-- @if (Route::is('admin.instructor-requests.index') || Route::is('admin.course-languages.index') || Route::is('admin.course-languages.create') || Route::is('admin.course-languages.edit') || Route::is('admin.course-levels.index') || Route::is('admin.course-levels.create') || Route::is('admin.course-levels.edit') || Route::is('admin.course-categories.index') || Route::is('admin.course-categories.create') || Route::is('admin.course-categories.edit'))
            @else
                @include('admin.layouts.header')
            @endif --}}
            <!-- Page body -->
            @yield('content')
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>
    <!-- Modals -->
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z">
                        </path>
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-secondary">Do you really want to remove this record? What you've done cannot be
                        undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100">
                                    Cancel
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger w-100 delete-confirm-btn">
                                    Delete
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dynamic_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg dynamic-modal-content">
            {{-- @include('front.pages.instructor.course.components.partials.course-chapter-modal') --}}
        </div>
    </div>

    <!-- Libs JS -->
    <script src="/vendor/flasher/flasher-notyf.min.js"></script>

    <!-- Tabler Core -->
    <script src="/admin/assets/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/admin/assets/dist/js/demo.min.js?1692870487" defer></script>
    <script src="/admin/assets/dist/js/jquery.nice-select.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="/admin/assets/dist/js/jquery-ui.min.js"></script>

    @stack('scripts')
</body>

</html>
