@push('stylesheets')
    <style>
        .notyf__toast {
            max-width: 50em !important;
        }
        .notyf__toast .notyf__ripple {
            height: 60em;
            width: 60em;
        }
    </style>
@endpush
<section class="wsus__offer" style="background: url(/front/images/offer_bg.jpg);">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-4 col-md-6 wow fadeInLeft">
                <div class="wsus__offer_img">
                    <img src="/front/images/offer_img_1.png" alt="Offer" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-xl-6 col-md-6 wow fadeInRight">
                <div class="wsus__offer_text">
                    <h2>Eager to Receive Special Offers & Updates on Courses?</h2>
                    <form class="newsletter_form">
                        @csrf
                        <input type="text" placeholder="Your email address..." name="email">
                        <button type="submit" class="common_btn nf_btn_sumit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        const csrf_token = $('meta[name="csrf-token"]').attr('content');
        const base_url = $('meta[name="base_url"]').attr('content');
        $(function() {
            $('.newsletter_form').on('submit', function(e) {
                e.preventDefault();
                let notyf = new Notyf({
                    useShadowDOM: false
                });
                let formData = $(this).serialize();
                let email = $(this).find('input[name="email"]');
                let btnSumbitNewsletter = $(this).find('.nf_btn_sumit');
                $.ajax({
                    method: 'POST',
                    url: `${base_url}/newsletter/subscribe`,
                    data: formData,
                    beforeSend: function() {
                        btnSumbitNewsletter.html(
                            '<i class="fa fa-spinner fa-spin"></i> Subscribing...');
                        email.attr('placeholder', 'Please wait...');
                        email.prop('disabled', true);
                    },
                    success: function(data) {
                        notyf.success(data.message);
                        email.val('');
                        email.attr('placeholder', 'Your email address...');
                        email.prop('disabled', false);
                        btnSumbitNewsletter.html('Subscribe');
                    },
                    error: function(xhr, status, error) {
                        notyf.error(xhr.responseJSON.message);
                        email.val('');
                        email.attr('placeholder', 'Your email address...');
                        email.prop('disabled', false);
                        btnSumbitNewsletter.html('Subscribe');
                    },
                })
            });
        })
    </script>
@endpush
