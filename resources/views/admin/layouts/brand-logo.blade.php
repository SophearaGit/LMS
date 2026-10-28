{{--
    Brand logo with safe fallbacks.
    $on = 'dark'  → for dark backgrounds (sidebar): uploaded site logo, else the white-text CAITD logo
    $on = 'light' → for light backgrounds (login card): the coloured CAITD logo
    $on = 'auto'  → follows the admin light/dark theme
    $on = 'sidebar' → mark + text wordmark lined up with the sidebar menu
--}}
@php
    $on = $on ?? 'dark';
    $height = $height ?? 36;
    $uploaded = config('settings.site_logo');
    $darkLogo = $uploaded && is_file(public_path(ltrim($uploaded, '/'))) ? asset($uploaded) : asset('front/images/footer_logo.png');
    $lightLogo = asset('front/images/logo.png');
    $alt = config('settings.site_name') ?: 'CAITD';
@endphp
@if ($on === 'sidebar')
    {{-- Uploaded logo when it exists; otherwise the CAITD mark + a crisp text wordmark --}}
    @if ($uploaded && is_file(public_path(ltrim($uploaded, '/'))))
        <img src="{{ asset($uploaded) }}" alt="{{ $alt }}" style="height: {{ $height }}px; width: auto; max-width: 100%;">
    @else
        <span class="brand-lockup">
            <img src="{{ asset('admin/brand/caitd-mark.png') }}" alt="" class="brand-lockup-mark" style="height: {{ $height }}px;">
            <span class="brand-lockup-word">{{ $alt }}</span>
        </span>
    @endif
@elseif ($on === 'auto')
    <img src="{{ $lightLogo }}" alt="{{ $alt }}" class="hide-theme-dark" style="height: {{ $height }}px; width: auto; max-width: 100%;">
    <img src="{{ $darkLogo }}" alt="{{ $alt }}" class="hide-theme-light" style="height: {{ $height }}px; width: auto; max-width: 100%;">
@else
    <img src="{{ $on === 'light' ? $lightLogo : $darkLogo }}" alt="{{ $alt }}" style="height: {{ $height }}px; width: auto; max-width: 100%;">
@endif
