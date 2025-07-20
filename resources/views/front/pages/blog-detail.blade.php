@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('meta')
    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:description" content="{{ $blog->description }}" />
    <meta property="og:image" content="{{ $blog->image }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="Blog" />
@endpush
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="wsus__blog_details mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__blog_details_area">
                        <div class="wsus__blog_details_thumb">
                            <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid w-100">
                        </div>
                        <div class="wsus__blog_details_header">
                            <ul class="d-flex flex-wrap">
                                <li>
                                    <span class="author">
                                        <img src="{{ asset($blog->blog_author->image ? $blog->blog_author->image : '/default-images/avatar/avatar.jpg') }}"
                                            alt="user" class="img-fluid">
                                    </span>
                                    By {{ $blog->blog_author->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('/front/images/calendar_gray.png') }}" alt="calendar"
                                            class="img-fluid">
                                    </span>
                                    {{ $blog->created_at->format('F d, Y') }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('/front/images/bookmark_icon.png') }}" alt="bookmark"
                                            class="img-fluid">
                                    </span>
                                    {{ $blog->blog_category->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('/front/images/comment_icon_gray.png') }}" alt="bookmark"
                                            class="img-fluid">
                                    </span>
                                    {{ count($blog->comments) ?? 0 }} Comments
                                </li>
                            </ul>
                            <h2>
                                {{ $blog->title }}
                            </h2>
                        </div>
                        <div class="wsus__blog_details_text">
                            <article>
                                {!! $blog->description !!}
                            </article>
                            {{-- <div class="details_quot_text">
                                Donec sollicitudin eros porta lacinia feugiat. Donec et venenatis quam. Sed eu velit non
                                purus imperdiet sagittis a nunc. Phasellus eu euismod Intege erra pellentesque
                                luctusurna tempus id feugiat nec porta ac quam.
                                <h4>Dominic L. Ement</h4>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="blog_det_center_img">
                                        <img src="/front/images/blog_details_center_img_1.jpg" alt="img"
                                            class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="blog_det_center_img">
                                        <img src="/front/images/blog_details_center_img_2.jpg" alt="img"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <h2>Basic Steps For Achieving Realism in Lip Drawing in 7 Simple Moves.</h2>
                            <p>Nulla a ipsum nibh. Fusce purus elit, tristique vitae enim sed, auctor placerat est.
                                Maecenas consequat nibh consequat malesuada fringilla, mauris lorem dapibus metus, non
                                imperdiet nunc erat ultricies est. Praesent ames nec lorem sit amet leo consequat rutrum
                                non nibh sem eget metus.</p> --}}
                        </div>
                        <div class="wsus__blog_det_tags_share d-flex flex-wrap mt_50">
                            {{-- <ul class="tags d-flex flex-wrap align-items-center">
                                <li><span>Tags:</span></li>
                                <li><a href="#">Course</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Online</a></li>
                            </ul> --}}
                            <ul class="share d-flex flex-wrap align-items-center">
                                <li><span>share:</span></li>
                                {{-- <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li> --}}

                                <li class="ez-facebook"><a href=""><i class="fab fa-facebook-f"
                                            aria-hidden="true"></i></a></li>
                                <li class="ez-linkedin"><a href=""><i class="fab fa-linkedin-in"
                                            aria-hidden="true"></i></a></li>
                                <li class="ez-x"><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="javascript:;"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li class="ez-reddit"><a href="#"><i class="fab fa-reddit" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="wsus__blog_det_author">
                            <div class="img">
                                <img src="{{ asset($blog->blog_author->image ? $blog->blog_author->image : '/default-images/avatar/avatar.jpg') }}"
                                    alt="Author" class="img-fluid">
                            </div>
                            <div class="text">
                                <h3>{{ $blog->blog_author->name }}</h3>
                                <h5>Digital Marketing</h5>
                                <p>Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec pharetra rutrum sed
                                    allium lectus fermentum enim Nam maximus.</p>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wsus__blog_comment_area mt_75">
                            <h2>Comments</h2>
                            @auth
                                @if ($blog->comments->count() > 0)
                                    @foreach ($blog->comments()->latest()->get() as $comment)
                                        <div class="wsus__blog_single_comment">
                                            <div class="img">
                                                <img src="{{ asset($comment->user->image) }}" alt="Comments" class="img-fluid">
                                            </div>
                                            <div class="text">
                                                <h4>{{ $comment->user->name }}</h4>
                                                <h6>{{ $comment->created_at->format('F d, Y \a\t h:i a') }} <a
                                                        href="#"><i class="fas fa-reply" aria-hidden="true"></i></a></h6>
                                                <p>{!! $comment->comment !!}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="details_quot_text">
                                        <h2>No Comments Found</h2>
                                        <p>Be the first to comment on this blog.</p>
                                    </div>
                                @endif
                            @else
                                <div class="details_quot_text">
                                    <p class="text-center alert alert-info font-extrabold text-uppercase">Please <a href="{{ route('login') }}">login</a> to see a
                                        comment.</p>
                                </div>
                            @endauth
                            {{-- <div class="wsus__blog_single_comment single_comment_reply">
                                <div class="text">
                                    <h4>Doug Lyphe</h4>
                                    <h6>June 25, 2024 at 08:45 pm <a href="#"><i class="fas fa-reply"
                                                aria-hidden="true"></i></a></h6>
                                    <p>Nulla a ipsum nibh. Fusce purus elit, tristique vitae enim sed, auctor placerat
                                        est. Maecenas consequat nibh consequat malesuada fringilla, mauris lorem dapibus
                                        metus, non imperdiet nunc erat ultricies est. Praesent ames nec lorem sit amet
                                        leo consequat rutrum non nibh sem eget metus.</p>
                                </div>
                            </div> --}}
                        </div>
                        <div class="wsus__blog_comment_input_area mt_75">
                            <h2>Post a Comment</h2>
                            @auth
                                <p>
                                    Say something about this post.
                                </p>
                                <form action="{{ route('blog.comment.store', $blog->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12 mb-4">
                                            <textarea rows="5" placeholder="Leave a comment...." name="comment"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="common_btn">Post Comment</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="details_quot_text">
                                    <p class="text-center alert alert-info font-extrabold text-uppercase">Please <a href="{{ route('login') }}">login</a> to post a
                                        comment.</p>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__blog_sidebar wsus__sidebar">

                        <form action="{{ route('blog.index') }}" class="wsus__sidebar_search">
                            <input type="text" placeholder="Search Here..." name="search">
                            <button type="submit">
                                <img src="{{ asset('/front/images/search_icon.png') }}" alt="Search"
                                    class="img-fluid">
                            </button>
                        </form>

                        <div class="wsus__sidebar_recent_post">
                            <h3>Recent Posts</h3>
                            <ul class="d-flex flex-wrap">
                                @forelse ($recentBlogPosts as $recentBlogPost)
                                    <li>
                                        <a href="{{ route('blog.detail', $recentBlogPost->slug) }}" class="img">
                                            <img src="{{ asset($recentBlogPost->image) }}" alt="Blog"
                                                class="img-fluid">
                                        </a>
                                        <div class="text">
                                            <p>
                                                <span>
                                                    <img src="{{ asset('/front/images/calendar_blue.png') }}"
                                                        alt="Clander" class="img-fluid">
                                                </span>
                                                {{ $recentBlogPost->created_at->format('F d, Y') }}
                                            </p>
                                            <a href="{{ route('blog.detail', $recentBlogPost->slug) }}" class="title">
                                                {{ Str::limit($recentBlogPost->title, 50) }}
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li>No recent posts available.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_category">
                            <h3>Categories</h3>
                            <ul>
                                @forelse ($blogCategories as $blogCategorie)
                                    <li>
                                        <a href="{{ route('blog.index', ['category' => $blogCategorie->slug]) }}">{{ $blogCategorie->name }}
                                            <span>({{ $blogCategorie->blogs_count }})</span></a>
                                    </li>
                                @empty
                                    <li>No categories available.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_tags">
                            <h3>Tags</h3>
                            <ul class="d-flex flex-wrap">
                                <li><a href="#">Course</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Online</a></li>
                                <li><a href="#">eLearning</a></li>
                                <li><a href="#">LMS</a></li>
                                <li><a href="#">Development</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
