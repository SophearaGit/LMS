@php
    $categories = App\Models\CourseCategory::with([
        'subCategories' => function ($query) {
            $query->where('status', 1)->whereHas('courses', function ($q) {
                $q->where('is_approved', 'approved')->where('status', 'active');
            });
        },
    ])
        ->whereNull('parent_id')
        ->where('show_at_trending', 1)
        ->where('status', 1)
        ->whereHas('subCategories', function ($query) {
            $query->where('status', 1)->whereHas('courses', function ($q) {
                $q->where('is_approved', 'approved')->where('status', 'active');
            });
        })
        ->latest()
        ->get();
@endphp

<section class="wsus__category_4 mt_190 xs_mt_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 m-auto wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="wsus__section_heading mb_35">
                    <h5>Categories</h5>
                    <h2>Explore Categories</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-xxl-3 col-md-6 col-lg-4 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <a href="{{ route('courses', ['main_category' => $category->slug]) }}"
                        class="wsus__single_category_4">
                        <div class="icon">
                            {{-- <img src="{{ asset('/front/images/category_icon_1.png') }}" alt="category"
                                class="img-fluid w-100"> --}}
                            <i class="{{ $category->icon }} text-black" style="font-size: 35px;"></i>
                        </div>
                        <div class="text">
                            <h4>
                                {{ $category->name }}
                            </h4>
                            {{-- <p>
                                {{ $category->courses_count }}
                                Course
                            </p> --}}
                        </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>
        <div class="row mt_60 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="col-12 text-center">
                <a class="common_btn" href="#">View All Categories <i class="far fa-angle-right"
                        aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</section>
