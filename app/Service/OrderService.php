<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Enrollments;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    // storeOrder
    public static function storeOrder(
        string $transaction_id,
        int $buyer_id,
        string $status,
        float $total_amount,
        float $paid_amount,
        string $currency,
        string $payment_method,
    ) {
        try {
            // Store in order table.
            $order = new Order();
            $order->invoice_id = uniqid();
            $order->buyer_id = $buyer_id;
            $order->status = $status;
            $order->total_amount = $total_amount;
            $order->paid_amount = $paid_amount;
            $order->currency = $currency;
            $order->transaction_id = $transaction_id;
            $order->payment_method = $payment_method;
            $order->save();

            // Store in order_items table.
            $cart = Cart::where('user_id', $buyer_id);
            $cart_items = $cart->get();
            foreach ($cart_items as $item) {
                $order_items = new OrderItem();
                $order_items->order_id = $order->id;
                $order_items->course_id = $item->course->id;

                $order_items->price = number_format(
                    $item->course->discount > 0
                        ? $item->course->price * (1 - ($item->course->discount / 100))
                        : $item->course->price,
                    2,
                    '.',
                    ''
                );


                $order_items->commission_rate = config('settings.commission', 0);
                $order_items->save();
                // Store in enrollments table.
                $enrollment = new Enrollments();
                $enrollment->user_id = $buyer_id;
                $enrollment->course_id = $item->course->id;
                $enrollment->instructor_id = $item->course->instructor_id;
                $enrollment->save();
                $instructorWallet = $item->course->instructor;
                if ($item->course->discount > 0) {
                    $commissionBase = $item->course->price * (1 - ($item->course->discount / 100));
                } else {
                    $commissionBase = $item->course->price;
                }
                $commissionRate = config('settings.commission', 0);
                $commission = calculateCommission($commissionBase, $commissionRate);
                $instructorEarnings = $commissionBase - $commission;

                // Ensure correct money format (2 decimal places)
                $instructorEarnings = number_format($instructorEarnings, 2, '.', '');

                $instructorWallet->wallet = number_format(
                    $instructorWallet->wallet + $instructorEarnings,
                    2,
                    '.',
                    ''
                );

                $instructorWallet->save();
            }
            $cart->delete();
        } catch (\Throwable $e) {
            throw $e;
        }

    }
}
