<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<style>
    .razorpay-payment-button {
        display: none;
    }
</style>

<body>

    @php
        $payable_amount = cartTotalPrice() * 100 * config('gateway_setting.razorpay_rate');
    @endphp

    <form action="{{ route('razorpay.payment') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('gateway_setting.razorpay_key_id') }}"
            data-currency="{{ config('gateway_setting.razorpay_currency') }}" data-amount="{{ $payable_amount }}"
            data-buttontext="Pay with Razorpay" data-name="Course" data-description="Payment for the course"
            data-theme.color="#ff7529"></script>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var auto_click = document.querySelector('.razorpay-payment-button');
            if (auto_click) {
                auto_click.click();
            }
        });
    </script>

</body>

</html>
