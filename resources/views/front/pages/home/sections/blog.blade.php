<section class="blog_4 mt_110 xs_mt_90 pt_120 xs_pt_100 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 wow fadeInLeft">
                <div class="wsus__section_heading heading_left mb_50">
                    <h5>Latest blogs</h5>
                    <h2>Our Latest News Feed.</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row blog_4_slider">
        @forelse ($blogs as $blog)
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="{{ route('blog.detail', $blog->slug) }}" class="wsus__single_blog_4_img">
                        <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid">
                        <span class="date">
                            {{ $blog->created_at->format('F d, Y') }}
                        </span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('/front/images/user_icon_black.png') }}" alt="User"
                                        class="img-fluid"></span>
                                By {{ $blog->blog_author->name }}
                            </li>
                            <li>
                                <span><img src="{{ asset('/front/images/comment_icon_black.png') }}" alt="Comment"
                                        class="img-fluid"></span>
                                {{ count($blog->comments) ?? 0 }} Comments
                            </li>
                        </ul>
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="title">
                            {{ $blog->title }}
                        </a>
                        <article>
                            <p>{{ Str::limit(strip_tags($blog->description), 80, '...') }}</p>
                        </article>
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="common_btn">Read More <i
                                class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</section>
