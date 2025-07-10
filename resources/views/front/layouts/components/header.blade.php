@php
    $topBarItems = \App\Models\TopBar::first();
@endphp
<header class="header_3">
    <div class="row">
        <div class="col-xxl-4 col-lg-7 col-md-8 d-none d-md-block">
            <ul class="wsus__header_left d-flex flex-wrap">
                <li><a href="mailto:{{ $topBarItems?->email }}"><i class="fas fa-envelope"></i>
                        {{ $topBarItems?->email }}</a></li>
                <li><a href="#"><i class="fas fa-phone-alt"></i> {{ $topBarItems?->phone }}</a></li>
                {{-- <li><a href="#"><i class="fab fa-instagram"></i> 58k Followers</a></li> --}}
            </ul>
        </div>
        <div class="col-xxl-5 col-lg-7 d-none d-xxl-block">
            <div class="wsus__header_center">
                <p> <span>{{ $topBarItems?->offer_name }}</span>
                    {{ Str::limit($topBarItems?->offer_description, 30, '...') }} <a
                        href="{{ $topBarItems?->offer_button_link }}"
                        target="_blank">{{ $topBarItems?->offer_button_text }}</a></p>
            </div>
        </div>
        {{-- <div class="col-xxl-3 col-lg-5 col-md-4">
            <ul class="wsus__header_right d-flex flex-wrap">
                <li>
                    <select class="select_js">
                        <option value="">English </option>
                        <option value="">Japanese</option>
                        <option value="">Korean</option>
                        <option value="">Chinese</option>
                        <option value="">Urdu</option>
                    </select>
                </li>
                <li>
                    <select class="select_js">
                        <option value="">$USD</option>
                        <option value="">₹INR</option>
                        <option value="">¥CNY</option>
                        <option value="">€EUR</option>
                        <option value="">฿THB</option>
                    </select>
                </li>
            </ul>
        </div> --}}
    </div>
</header>
