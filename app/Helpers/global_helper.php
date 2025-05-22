<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (!function_exists('calculateCommission')) {
    function calculateCommission($amount, $commission)
    {
        if ($amount == 0 || $commission == 0) {
            return 0;
        }
        return ($amount * $commission) / 100;
    }
}

if (!function_exists('minToHours')) {
    function minToHours($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        return sprintf('%dh %02dmin', $hours, $remainingMinutes);
    }
}

if (!function_exists('cartTotalPrice')) {
    function cartTotalPrice()
    {
        $total = 0;

        $cart = Cart::where('user_id', Auth::guard('web')->user()?->id)->get();

        foreach ($cart as $item) {
            $course = $item->course;
            if ($course) {
                $total += $course->price - ($course->price * $course->discount / 100);
            }
        }

        return number_format($total, 2, '.', '');
    }
}

if (!function_exists('cartTotalCourseCount')) {
    function cartTotalCourseCount()
    {
        $cart = Cart::where('user_id', Auth::guard('web')->user()?->id)->get();
        return $cart->count();
    }
}
