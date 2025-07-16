@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="wsus__blog_page mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-xl-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__single_blog_4">
                            <a href="{{ route('blog.detail', $blog->slug) }}" class="wsus__single_blog_4_img">
                                <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid">
                                <span class="date">{{ $blog->created_at->format('F d, Y') }}</span>
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
                                        3 Comments
                                    </li>
                                </ul>
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="title">{{ $blog->title }}</a>
                                <article>
                                    <p>{{ Str::limit(strip_tags($blog->description), 130, '...') }}</p>
                                </article>
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="common_btn">Read More <i
                                        class="far fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__no_data_found">
                            <h2>No Blogs Found</h2>
                            <p>We couldn't find any blogs matching your criteria.</p>
                        </div>
                    </div>
                @endforelse
                <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <nav aria-label="Page navigation example">
                        {{ $blogs->withQueryString()->links('vendor.pagination.front.custom') }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
