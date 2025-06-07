<section class="wsus__video mt_120 xs_mt_100">
    <img src="{{ $videoSectionItems->background_image }}" alt="Video" class="img-fluid w-100">
    <a class="play_btn venobox" data-autoplay="true" data-vbtype="video" href="{{ $videoSectionItems->video_url }}">
        <img src="/front/images/play_icon_white.png" alt="Play" class="img-fluid">
    </a>
    <div class="text wow fadeInLeft">
        {!! $videoSectionItems->description !!}
        <a href="{{ $videoSectionItems->button_url  }}">Free Online Courses <i class="far fa-arrow-right"></i></a>
    </div>
</section>
