{{--
    Favicon + app icons for every admin page.
    Uses the favicon uploaded in Site Settings when that file really exists,
    otherwise the bundled CAITD icon, so the tab never falls back to a blank globe.
--}}
@php
    $brandFavicon = config('settings.site_favicon');
    $brandFavicon = $brandFavicon && is_file(public_path(ltrim($brandFavicon, '/'))) ? asset($brandFavicon) : asset('favicon.png');
@endphp
<link rel="icon" href="{{ $brandFavicon }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
<meta name="theme-color" content="#1d273b">
