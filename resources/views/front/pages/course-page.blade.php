@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @include('front.pages.partials.bread-crumb')
    <section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft"
                    style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__sidebar">
                        <form action="#">
                            <div class="wsus__sidebar_search">
                                <input type="text" placeholder="Search Course">
                                <button type="submit">
                                    <img src="/front/images/search_icon.png" alt="Search" class="img-fluid">
                                </button>
                            </div>
                            <div class="wsus__sidebar_category">
                                <h3>Categories</h3>
                                <ul class="categoty_list">
                                    <li class="">Bundle Courses
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc1">
                                                <label class="form-check-label" for="flexCheckDefaultc1">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc2">
                                                <label class="form-check-label" for="flexCheckDefaultc2">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc3">
                                                <label class="form-check-label" for="flexCheckDefaultc3">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc44">
                                                <label class="form-check-label" for="flexCheckDefaultc44">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Development
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc5">
                                                <label class="form-check-label" for="flexCheckDefaultc5">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc6">
                                                <label class="form-check-label" for="flexCheckDefaultc6">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc7">
                                                <label class="form-check-label" for="flexCheckDefaultc7">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc4">
                                                <label class="form-check-label" for="flexCheckDefaultc4">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Live class
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc9">
                                                <label class="form-check-label" for="flexCheckDefaultc9">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc10">
                                                <label class="form-check-label" for="flexCheckDefaultc10">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc11">
                                                <label class="form-check-label" for="flexCheckDefaultc11">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc12">
                                                <label class="form-check-label" for="flexCheckDefaultc12">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>IT &amp; Software
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc13">
                                                <label class="form-check-label" for="flexCheckDefaultc13">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc14">
                                                <label class="form-check-label" for="flexCheckDefaultc14">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc15">
                                                <label class="form-check-label" for="flexCheckDefaultc15">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc66">
                                                <label class="form-check-label" for="flexCheckDefaultc66">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Health &amp; Fitness
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc17">
                                                <label class="form-check-label" for="flexCheckDefaultc17">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc18">
                                                <label class="form-check-label" for="flexCheckDefaultc18">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc19">
                                                <label class="form-check-label" for="flexCheckDefaultc19">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc20">
                                                <label class="form-check-label" for="flexCheckDefaultc20">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>Data Science
                                        <div class="wsus__sidebar_sub_category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc21">
                                                <label class="form-check-label" for="flexCheckDefaultc21">
                                                    Game developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc22">
                                                <label class="form-check-label" for="flexCheckDefaultc22">
                                                    Apple
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc23">
                                                <label class="form-check-label" for="flexCheckDefaultc23">
                                                    Career developments
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefaultc24">
                                                <label class="form-check-label" for="flexCheckDefaultc24">
                                                    Communication
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="wsus__sidebar_course_lavel">
                                <h3>Difficulty Level</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Higher
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        Medium
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        Lowest
                                    </label>
                                </div>
                            </div>

                            <div class="wsus__sidebar_course_lavel rating">
                                <h3>Rating</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr1">
                                    <label class="form-check-label" for="flexCheckDefaultr1">
                                        <i class="fas fa-star" aria-hidden="true"></i> 5 star
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr2">
                                    <label class="form-check-label" for="flexCheckDefaultr2">
                                        <i class="fas fa-star" aria-hidden="true"></i> 4 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr3">
                                    <label class="form-check-label" for="flexCheckDefaultr3">
                                        <i class="fas fa-star" aria-hidden="true"></i> 3 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr4">
                                    <label class="form-check-label" for="flexCheckDefaultr4">
                                        <i class="fas fa-star" aria-hidden="true"></i> 2 star or above
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultr5">
                                    <label class="form-check-label" for="flexCheckDefaultr5">
                                        <i class="fas fa-star" aria-hidden="true"></i> 1 star or above
                                    </label>
                                </div>
                            </div>

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Duration</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultd1">
                                    <label class="form-check-label" for="flexCheckDefaultd1">
                                        Less Than 24 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultd2">
                                    <label class="form-check-label" for="flexCheckDefaultd2">
                                        24 to 36 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultd3">
                                    <label class="form-check-label" for="flexCheckDefaultd3">
                                        36 to 72 Hours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultd4">
                                    <label class="form-check-label" for="flexCheckDefaultd4">
                                        Above 70 Hours
                                    </label>
                                </div>
                            </div>

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Language</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaulte1">
                                    <label class="form-check-label" for="flexCheckDefaulte1">
                                        Bangla
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaulte2">
                                    <label class="form-check-label" for="flexCheckDefaulte2">
                                        English
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaulte3">
                                    <label class="form-check-label" for="flexCheckDefaulte3">
                                        Hindi
                                    </label>
                                </div>
                            </div>

                            <div class="wsus__sidebar_rating">
                                <h3>Price Range</h3>
                                <div class="range_slider">
                                    <div class="al-range-slider js-al-range-slider al-range-slider_dark">
                                        <div class="al-range-slider__track js-al-range-slider__track">
                                            <div class="al-range-slider__grid js-al-range-slider__grid"><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0" style="left: 0%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">10</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0101" style="left: 1.01%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0202" style="left: 2.02%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0303" style="left: 3.03%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0404" style="left: 4.04%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.0505" style="left: 5.05%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">60</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0606" style="left: 6.06%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0707" style="left: 7.07%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0808" style="left: 8.08%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.0909" style="left: 9.09%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.101" style="left: 10.1%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">110</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1111" style="left: 11.11%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1212" style="left: 12.12%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1313" style="left: 13.13%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1414" style="left: 14.14%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.1515" style="left: 15.15%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">160</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1616" style="left: 16.16%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1717" style="left: 17.17%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1818" style="left: 18.18%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.1919" style="left: 19.19%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.202" style="left: 20.2%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">210</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2121" style="left: 21.21%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2222" style="left: 22.22%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2323" style="left: 23.23%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2424" style="left: 24.24%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.2525" style="left: 25.25%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">260</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2626" style="left: 26.26%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2727" style="left: 27.27%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2828" style="left: 28.28%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.2929" style="left: 29.29%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.303" style="left: 30.3%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">310</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3131" style="left: 31.31%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3232" style="left: 32.32%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3333" style="left: 33.33%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3434" style="left: 34.34%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.3535" style="left: 35.35%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">360</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3636" style="left: 36.36%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3737" style="left: 37.37%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3838" style="left: 38.38%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.3939" style="left: 39.39%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.404" style="left: 40.4%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">410</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4141" style="left: 41.41%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4242" style="left: 42.42%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4343" style="left: 43.43%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4444" style="left: 44.44%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.4545" style="left: 45.45%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">460</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4646" style="left: 46.46%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4747" style="left: 47.47%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4848" style="left: 48.48%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.4949" style="left: 49.49%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.5051" style="left: 50.51%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">510</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5152" style="left: 51.52%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5253" style="left: 52.53%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5354" style="left: 53.54%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5455" style="left: 54.55%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.5556" style="left: 55.56%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">560</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5657" style="left: 56.57%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5758" style="left: 57.58%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.5859" style="left: 58.59%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.596" style="left: 59.6%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.6061" style="left: 60.61%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">610</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6162" style="left: 61.62%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6263" style="left: 62.63%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6364" style="left: 63.64%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6465" style="left: 64.65%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.6566" style="left: 65.66%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">660</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6667" style="left: 66.67%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6768" style="left: 67.68%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.6869" style="left: 68.69%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.697" style="left: 69.7%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.7071" style="left: 70.71%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">710</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7172" style="left: 71.72%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7273" style="left: 72.73%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7374" style="left: 73.74%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7475" style="left: 74.75%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.7576" style="left: 75.76%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">760</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7677" style="left: 76.77%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7778" style="left: 77.78%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.7879" style="left: 78.79%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.798" style="left: 79.8%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.8081" style="left: 80.81%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">810</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8182" style="left: 81.82%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8283" style="left: 82.83%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8384" style="left: 83.84%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8485" style="left: 84.85%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.8586" style="left: 85.86%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">860</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8687" style="left: 86.87%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8788" style="left: 87.88%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.8889" style="left: 88.89%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.899" style="left: 89.9%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.9091" style="left: 90.91%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">910</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9192" style="left: 91.92%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9293" style="left: 92.93%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9394" style="left: 93.94%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9495" style="left: 94.95%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="0.9596" style="left: 95.96%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">960</span></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9697" style="left: 96.97%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9798" style="left: 97.98%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick"
                                                    data-position="0.9899" style="left: 98.99%;"></span><span
                                                    class="al-range-slider__grid-tick js-al-range-slider__grid-tick al-range-slider__grid-tick_long"
                                                    data-position="1" style="left: 100%;"><span
                                                        class="al-range-slider__grid-mark js-al-range-slider__grid-mark">1000</span></span>
                                            </div><span class="al-range-slider__knob js-al-range-slider__knob"
                                                style="left: 19.19%;"><span
                                                    class="al-range-slider__tooltip js-al-range-slider__tooltip">200</span></span><span
                                                class="al-range-slider__knob js-al-range-slider__knob"
                                                style="left: 79.8%;"><span
                                                    class="al-range-slider__tooltip js-al-range-slider__tooltip">800</span></span><span
                                                class="al-range-slider__bar js-al-range-slider__bar"
                                                style="left: 19.19%; width: 60.61%;"></span>
                                        </div><input class="al-range-slider__input js-al-range-slider__input"
                                            name="from" type="text"><input
                                            class="al-range-slider__input js-al-range-slider__input" name="to"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 order-lg-1">
                    <div class="wsus__page_courses_header wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <p>Showing <span>1-9</span> Of <span>62</span> Results</p>
                        <form action="#">
                            <p>Sort-by:</p>
                            <select class="select_js" style="display: none;">
                                <option value="">Regular</option>
                                <option value="">Top Rated</option>
                                <option value="">Popular Courses</option>
                                <option value="">Recent Courses</option>
                            </select>
                            <div class="nice-select select_js" tabindex="0"><span class="current">Regular</span>
                                <ul class="list">
                                    <li data-value="" class="option selected">Regular</li>
                                    <li data-value="" class="option">Top Rated</li>
                                    <li data-value="" class="option">Popular Courses</li>
                                    <li data-value="" class="option">Recent Courses</li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-xl-4 col-md-6 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;" data-tilt>
                                <div class="wsus__single_courses_3">
                                    <div class="wsus__single_courses_3_img">
                                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/love_icon_black.png" alt="Love"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/compare_icon_black.png" alt="Compare"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="/front/images/cart_icon_black_2.png" alt="Cart"
                                                        class="img-fluid">
                                                </a>
                                            </li>
                                        </ul>
                                        <span class="time"><i class="far fa-clock" aria-hidden="true"></i>
                                            {{ minToHours($course->duration) }}</span>
                                    </div>
                                    <div class="wsus__single_courses_text_3">
                                        <div class="rating_area">
                                            <!-- <a href="#" class="category">Design</a> -->
                                            <p class="rating">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <span>(4.8 Rating)</span>
                                            </p>
                                        </div>
                                        <a class="title"
                                            href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                        <ul>
                                            <li>{{ $course->lessons->count() }} Lessons</li>
                                            <li>38 Student</li>
                                        </ul>
                                        <a class="author" href="#">
                                            <div class="img">
                                                <img src="{{ $course->instructor->image }}" alt="Author"
                                                    class="img-fluid">
                                            </div>
                                            <h4>{{ $course->instructor->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="wsus__single_courses_3_footer">
                                        <a id="add_to_cart_btn_{{ $course->id }}" class="common_btn add_to_cart_btn"
                                            data-course-id="{{ $course->id }}" href="#">Add to cart<i
                                                class="far fa-arrow-right" aria-hidden="true"></i></a>
                                        <p>
                                            @if ($course->price == 0)
                                                Free
                                            @else
                                                @if ($course->discount > 0)
                                                    <del>
                                                        <small>
                                                            ${{ number_format($course->price, 2) }}
                                                        </small>
                                                    </del>
                                                    ${{ number_format($course->price - ($course->price * $course->discount) / 100, 2) }}
                                                @else
                                                    ${{ number_format($course->price, 2) }}
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: hidden; animation-name: none;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="far fa-arrow-left" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link active" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="far fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Variables.
        const base_url = $(`meta[name="base_url"]`).attr('content');
        const notyf = new Notyf({
            duration: 5000,
            dismissible: true,
            position: {
                x: 'right',
                y: 'bottom',
            },
        });

        // Reuseable functions.
        function add_to_cart(course_id) {
            $.ajax({
                method: 'POST',
                url: base_url + `/cart/${course_id}/store`,
                data: {
                    _token: csrf_token,

                },
                beforeSend: function() {
                    $(`#add_to_cart_btn_${course_id}`).html('<i class="fas fa-spinner fa-spin"></i>Adding...');
                },
                success: function(data) {
                    notyf.success(data.message);
                    $(`#add_to_cart_btn_${course_id}`).html('Add to cart');
                },
                error: function(xhr, status, error) {
                    let errors = xhr.responseJSON;
                    $.each(errors, function(key, value) {
                        notyf.error(value);
                    });
                    $(`#add_to_cart_btn_${course_id}`).html('Add to cart');
                },
            })
        }

        // On DOM load.
        $(function() {
            $('.add_to_cart_btn').on('click', function(e) {
                e.preventDefault();
                let course_id = $(this).data('course-id');
                add_to_cart(course_id)
            });
        });
    </script>
@endpush
