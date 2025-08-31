<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Orders',
            'orderItems' => OrderItem::whereHas('course', function ($query) {
                $query->where('instructor_id', Auth::id());
            })->latest()->paginate(25),
        ];
        return view('front.pages.instructor.order.index', $data);
    }

    public function invoice(Order $order)
    {
        $data = [
            'pageTitle' => 'CAITD | Order Invoice',
            'order' => $order::with('order_items.course')->findOrFail($order->id),
        ];
        return view('front.pages.instructor.order.show', $data);
    }


}
