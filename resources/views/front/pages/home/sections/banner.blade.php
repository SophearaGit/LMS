<section class="wsus__banner_3" style="background: url(/front/images/banner_3_bg.png);">
    <div class="row justify-content-between">
        <div class="col-xl-6 col-lg-6 wow fadeInUp">
            <div class="wsus__banner_3_text">
                <h5>{{ $heroItems?->label }}</h5>
                @php
                    $title = $heroItems?->title;
                    $lastWord = $title ? collect(explode(' ', $title))->last() : '';
                    $titleWithoutLast = $title ? trim(Str::beforeLast($title, ' ')) : '';
                @endphp
                <h1>
                    {{ $titleWithoutLast }}
                    <span>{{ $lastWord }}</span>
                </h1>
                <p class="description">{{ $heroItems?->subtitle }}</p>
                <div class="wsus__banner_2_btn_area mt_60">
                    <a class="common_btn" href="{{ $heroItems?->btn_url }}">
                        {{ $heroItems?->btn_txt }}
                        <i class="far fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <div class="play_btn_area">
                        <a class="play_btn venobox vbox-item" data-autoplay="true" data-vbtype="video"
                            href="{{ $heroItems?->vid_btn_url }}">
                            <img src="/front/images/play_icon.png" alt="Play" class="img-fluid">
                        </a>
                        <h4>{{ $heroItems?->vid_btn_txt }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 wow fadeInRight">
            <div class="wsus__banner_3_img">
                <div class="img">
                    <img src="{{ $heroItems->image }}" alt="Banner" class="img-fluid">
                    <div class="text">
                        <h4>{{ $heroItems?->banner_item_title }}</h4>
                        <p>{{ $heroItems?->banner_item_subtitle }}</p>
                    </div>
                    <div class="circle_box">
                        <svg viewBox="0 0 100 100">
                            <defs>
                                <path id="circle" d="
                                    M 50, 50
                                    m -37, 0
                                    a 37,37 0 1,1 74,0
                                    a 37,37 0 1,1 -74,0"></path>
                            </defs>
                            <text>
                                <textPath xlink:href="#circle">
                                    {{ $heroItems?->round_txt }}
                                </textPath>
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($featureItems)
        <ul class="wsus__banner_features d-flex flex-wrap">
            @foreach ($featureItems as $item)
                @php
                    $colors = ['green', 'pink', 'sky'];
                @endphp
                <li class="{{ $colors[$loop->index % count($colors)] }} wow fadeInRight">
                    <div class="icon">
                        <img src="{{ $item->icon }}" alt="Features" class="img-fluid">
                    </div>
                    <div class="text">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->description }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <ul class="wsus__banner_features d-flex flex-wrap">
            <li class="green wow fadeInRight">
                <div class="icon">
                    <img src="/front/images/banner_feature_icon_1.png" alt="Features" class="img-fluid">
                </div>
                <div class="text">
                    <h4>Learn From Experts</h4>
                    <p>LMS allows users to create organize and manage courses.</p>
                </div>
            </li>
            <li class="pink wow fadeInRight">
                <div class="icon">
                    <img src="/front/images/banner_feature_icon_2.png" alt="Features" class="img-fluid">
                </div>
                <div class="text">
                    <h4>Earn a Certificate</h4>
                    <p>LMS allows users to create organize and manage courses.</p>
                </div>
            </li>
            <li class="sky wow fadeInRight">
                <div class="icon">
                    <img src="/front/images/banner_feature_icon_3.png" alt="Features" class="img-fluid">
                </div>
                <div class="text">
                    <h4>5400+ Courses</h4>
                    <p>LMS allows users to create organize and manage courses.</p>
                </div>
            </li>
        </ul>
    @endif
</section>
