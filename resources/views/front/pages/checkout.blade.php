@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@push('stylesheets')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@section('content')
    @include('front.pages.partials.bread-crumb')

    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="payment_area">
                        <div class="row">
                            {{-- PAYPAL --}}
                            <div class="col-xl-4 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="{{ route('paypal.payment') }}" class="payment_mathod">
                                    <img src="/front/images/payment_2.png" alt="payment" class="img-fluid w-100"
                                        style="max-width: 150px !important;">
                                </a>
                            </div>
                            {{-- STRIPE --}}
                            {{-- <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="{{ route('stripe.payment') }}" class="payment_mathod">
                                    <img src="/front/images/payment_4.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div> --}}
                            {{-- RAZORPAY --}}
                            {{-- <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="{{ route('razorpay.redirect') }}" class="payment_mathod">
                                    <img src="/front/images/payment_4.png" alt="payment" class="img-fluid w-100">
                                    <h2>Razorpay</h2>
                                </a>
                            </div> --}}
                            {{-- ABA Payway --}}
                            <div class="col-xl-4 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" id="aba_click_pay">
                                    <span>
                                        <img src="/front/images/abapayway.png" alt="ABA Payway" class="img-fluid w-100"
                                            style="max-width: 250px !important;">
                                    </span>
                                </a>
                                {{-- <script>
                                    $('#aba_click_pay').on('click', function(e) {
                                        e.preventDefault();
                                        $('#aba_form').submit();
                                    });
                                </script>
                                <form action="{{ route('aba.payment') }}" method="POST" id="aba_form">
                                    @csrf
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="total_payment_price">
                        <h4>Total Cart <span>(0{{ cartTotalCourseCount() }})</span></h4>
                        <ul>
                            <li>Total price:<span>${{ cartTotalPrice() }}</span></li>
                        </ul>
                        {{-- <a href="#" class="common_btn">now payment</a> --}}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="aba_qr_modal" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #c5c5db !important;">
                        <div class="modal-header">
                            <h5 class="modal-title ">
                                <span class="text-center">
                                    <img src="/front/images/abapayway.png" alt="ABA Payway" class="img-fluid w-100"
                                        style="max-width: 250px !important;">
                                </span>
                                {{-- <strong>
                                    ABA KHQR Payment
                                </strong> --}}
                            </h5>
                            <button type="button" onclick="location.reload();" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close" id="closeBtn"></button>
                        </div>
                        <div class="modal-body" id="modal_body">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
@push('scripts')
    {{-- <script>
        $('#aba_click_pay').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: base_url + "/aba/payment",
                data: {
                    _token: csrf_token
                },
                beforeSend: function() {
                    $('#aba_click_pay').prop('disabled', true);
                },
                success: function(data) {
                    $('#aba_qr_modal').modal('show');
                },
                error: function(xhr, status, error) {

                },
            });
        });
    </script> --}}

    <script>
        let paymentCompleted = false;

        function startAbaPolling(tranId) {
            let interval = setInterval(function() {

                $.get(base_url + '/aba/check-status/' + tranId, function(res) {

                    if (res.status === 'paid' && !paymentCompleted) {
                        paymentCompleted = true;
                        clearInterval(interval);

                        $('#aba_qr_modal').modal('hide');
                        window.location.href =
                            base_url + '/student/enroll-courses';
                    }

                });

            }, 3000);
        }


        $('#aba_click_pay').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: base_url + "/aba/payment",
                data: {
                    _token: csrf_token
                },
                beforeSend: function() {
                    $('#aba_click_pay').prop('disabled', true);
                },
                success: function(res) {
                    if (res.status !== 'success') {
                        alert('Payment init failed');
                        return;
                    }

                    // 1. Inject QR image
                    $('#modal_body').html(`
                        <div class="text-center">
                            <img src="${res.data.qrImage}" alt="ABA QR Code" class="mb-3 rounded"  />

                            <strong>
                                ${res.amountUsd}
                            </strong> USD
                            <br/>
                            <strong>
                                ${res.amountKhr}
                            </strong> KHR
                            <br/>
                            <small class="text-muted">
                                Transaction ID: ${res.tran_id}
                            </small>
                            <br/>
                            <p class="mt-3 text-muted">
                                Scan with mobile banking app that supports KHQR
                            </p>
                            <br/>
                        </div>
                    `);

                    // 2. Show modal
                    $('#aba_qr_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');

                    // 3. Start checking payment status
                    startAbaPolling(res.tran_id);
                },
                error: function() {
                    alert('Server error. Please try again.');
                },
                complete: function() {
                    $('#aba_click_pay').prop('disabled', false);
                }
            });
        });
    </script>
@endpush
