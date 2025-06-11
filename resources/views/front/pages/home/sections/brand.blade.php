<section class="wsus__brand mt_45 pt_120 xs_pt_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wsus__brand_slider_area wow fadeInUp">
                    <h6>Our Outstanding Trusted Partners</h6>
                    <div class="marquee_animi">
                        <ul class="d-flex flex-wrap">
                            @foreach ($brandSecitonItems as $brandSecitonItem)
                                <li>
                                    <a href="{{ $brandSecitonItem?->url }}" target="_blank">
                                        <img src="{{ $brandSecitonItem?->image }}" alt="brand"
                                            class="img-fluid w-100">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
