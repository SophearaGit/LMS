<section class="wsus__about_counter wsus__counter mt_120 xs_mt_100">
    <div class="container">
        <div class="wsus__counter_bg" style="background: url(/front/images/counter_bg.jpg);">
            <div class="row">
                <div class="col-lg-3 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__single_counter">
                        <h2><span class="counter">{{ $counterItems?->counter_one }}</span></h2>
                        <p>{{ $counterItems?->title_one }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__single_counter">
                        <h2><span class="counter">{{ $counterItems?->counter_two }}</span></h2>
                        <p>{{ $counterItems?->title_two }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__single_counter">
                        <h2><span class="counter">{{ $counterItems?->counter_three }}</span></h2>
                        <p>{{ $counterItems?->title_one }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__single_counter">
                        <h2><span class="counter">{{ $counterItems?->counter_four }}</span></h2>
                        <p>{{ $counterItems?->title_four }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
