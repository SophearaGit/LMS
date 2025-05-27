@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.student.partials.breadcrum-banner')
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('front.pages.student.components.sidebar')
                <div class="col-xl-8 col-md-8">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 wow fadeInUp text-end">
                            <div class="wsus__dash_earning">
                                <a type="button" href="{{ route('student.dashboard') }}" class="common_btn">Go Back</a>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Become An Instructor</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('student.become_instructor_update', auth()->user()->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="wsus__login_form_input">
                                                <label for="document">Document</label>
                                                <input type="file" placeholder="Provide your document here."
                                                    id="document" name="document" value="" autofocus=""
                                                    autocomplete="document">
                                                <x-input-error :messages="$errors->get('document')" class="mt-2" />

                                            </div>
                                            <div class="wsus__login_form_input d-flex justify-content-end">
                                                <button type="submit" class="common_btn"
                                                    style="width: auto;">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
