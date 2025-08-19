<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentOrderController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Student Orders',
            'orders' => Order::where('buyer_id', Auth::id())->take(10)->get(),
        ];
        return view('front.pages.student.orders.index', $data);
    }

    public function invoice(Order $order)
    {
        $data = [
            'pageTitle' => 'CAITD | Order Invoice',
            'order' => $order::with('order_items.course')->findOrFail($order->id),
        ];
        return view('front.pages.student.orders.show', $data);
    }





}

