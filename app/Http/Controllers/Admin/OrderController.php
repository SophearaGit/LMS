<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $data = [
            'pageTitle' => 'Orders',
            'orders' => Order::with(['customer'])->paginate(25)
        ];
        return view('admin.pages.orders.index', $data);
    }
    public function show(Request $request, int $order_id)
    {
        $data = [
            'pageTitle' => 'Orders',
            'order' => Order::with(['customer'])->findOrFail($order_id),
        ];
        return view('admin.pages.orders.show', $data);
    }
}
