@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')

    @include('front.pages.partials.bread-crumb')

    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @foreach ($contacts as $contact)
                    <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__contact_info">
                            <div class="icon">
                                <img src="{{ $contact?->icon }}" alt="contact" class="img-fluid">
                            </div>
                            <h4>{{ $contact?->title }}</h4>
                            <p>{{ $contact?->line_one }}</p>
                            <p>{{ $contact?->line_two }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="wsus__contact_form_area mt_30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5 d-md-none d-lg-block">
                        <div class="wsus__contact_form_img">
                            <img src="{{ $contactSetting?->image }}" alt="contact" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">

                        <form action="{{ route('send.contact') }}" method="POST" class="wsus__contact_form">
                            @csrf
                            <h4>Send Us Message</h4>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <input type="text" placeholder="Name*" name="name" required>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <input type="email" placeholder="Email*" name="email" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <input type="text" placeholder="Subject*" name="subject" required>
                                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                                </div>
                                <div class="col-xl-12">
                                    <textarea rows="5" placeholder="Your message*" name="message" required></textarea>
                                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                    <button type="submit" class="common_btn">Submit Now</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @if ($contactSetting?->map_url)
            <div class="wsus__contact_map mt_120 xs_mt_100 wow fadeInUp"
                style="visibility: visible; animation-name: fadeInUp;">
                <iframe src="{{ $contactSetting?->map_url }}" width="600" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        @endif
    </section>

@endsection
