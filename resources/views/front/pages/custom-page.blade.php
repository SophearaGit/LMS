@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 15px;
        }

        .wsus__contact_form_area.mt_30.wow.fadeInUp {
            padding: 60px;
        }
    </style>
@endpush
@section('content')

    <section class="wsus__breadcrumb" style="background: url(/front/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>
                                {{ Str::limit($customPage->title, 100, '...') }}
                            </h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>
                                    {{ $customPage->title }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="wsus__contact_form_area mt_30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-6 d-md-none d-lg-block">
                        <article>
                            {!! $customPage->description !!}
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
