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
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <link href="/admin/assets/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="/admin/assets/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
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
            @if (Route::is('admin.instructor-requests.index'))
            @else
                @include('admin.layouts.header')
            @endif
            <!-- Page body -->
            @yield('content')
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>
    <!-- Modals -->

    <!-- Libs JS -->

    <!-- Tabler Core -->
    <script src="/admin/assets/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/admin/assets/dist/js/demo.min.js?1692870487" defer></script>

    @stack('scripts')
</body>

</html>
