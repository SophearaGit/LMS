@php
    $footer = \App\Models\Footer::first();
    $socialLinks = \App\Models\SocialLink::where('status', 1)->get();
    $footerColumnOnes = \App\Models\FooterColumnOne::where('status', 1)->get();
    $footerColumnTwos = \App\Models\FooterColumnTwo::where('status', 1)->get();
@endphp

<footer class="footer_3" style="background: url({{ asset('front/images/footer_3_bg.jpg') }});">
    <div class="footer_3_overlay pt_120 xs_pt_100">
        <div class="wsus__footer_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeInUp">
                        <div class="wsus__footer_3_logo_area">
                            <a class="logo" href="{{ asset('index.html') }}">
                                @if (config('settings.site_footer_logo'))
                                    <img src="{{ asset(config('settings.site_footer_logo')) }}" alt="CAITD"
                                        class="img-fluid">
                                @else
                                    <img src="{{ asset('front/images/footer_logo.png') }}" alt="CAITD"
                                        class="img-fluid">
                                @endif
                            </a>
                            <p>
                                {{ $footer?->description }}
                            </p>
                            <h2>Follow Us On</h2>
                            <ul class="d-flex flex-wrap">
                                @foreach ($socialLinks as $socialLink)
                                    <li><a href="{{ $socialLink->link }}" target="_blank"><img
                                                src="{{ asset($socialLink->icon) }}" alt=""
                                                style="width: 50px; height: 50px;"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>Help Links</h2>
                            <ul>
                                @foreach ($footerColumnOnes as $footerColumnOne)
                                    <li><a href="{{ $footerColumnOne->url }}">{{ $footerColumnOne->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                        <div class="wsus__footer_link">
                            <h2>More Links</h2>
                            <ul>
                                @foreach ($footerColumnTwos as $footerColumnTwo)
                                    <li><a href="{{ $footerColumnTwo->url }}">{{ $footerColumnTwo->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp">
                        <div class="wsus__footer_3_subscribe">
                            <h3>Connect with us</h3>
                            {{-- <form action="#">
                                <input type="text" placeholder="Enter Your Email">
                                <button type="submit" class="common_btn">Subscribe</button>
                            </form> --}}
                            <ul>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('front/images/mail.png') }}" alt="Call"
                                            class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Email us:</h4>
                                        <a href="mailto:{{ $footer?->email }}">{{ $footer?->email }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('front/images/call_icon_white.png') }}" alt="Call"
                                            class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Call us:</h4>
                                        <a href="callto:{{ $footer?->phone }}">{{ $footer?->phone }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <img src="{{ asset('front/images/location_icon_white.png') }}" alt="Call"
                                            class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>Office:</h4>
                                        <p>{{ $footer?->address }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__footer_copyright_area mt_140 xs_mt_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__footer_copyright_text text-center" style="display: block;">
                            <p>Copyright © 2024 All Rights Reserved by CAITD Education</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
