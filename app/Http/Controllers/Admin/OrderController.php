<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /** Labels for the payment_method values stored by PaymentController. */
    public const METHODS = [
        'aba'      => ['ABA PayWay', 'ti-building-bank'],
        'paypal'   => ['PayPal',     'ti-brand-paypal'],
        'stripe'   => ['Stripe',     'ti-brand-stripe'],
        'razorpay' => ['Razorpay',   'ti-credit-card'],
    ];

    public const PERIODS = [
        'any'   => 'Any time',
        'today' => 'Today',
        '7d'    => 'Last 7 days',
        '30d'   => 'Last 30 days',
        'month' => 'This month',
        'year'  => 'This year',
    ];

    public function index(Request $request)
    {
        $status = in_array($request->input('status'), ['approved', 'pending'], true) ? $request->input('status') : 'all';
        $method = array_key_exists((string) $request->input('method'), self::METHODS) ? $request->input('method') : '';
        $period = array_key_exists((string) $request->input('period'), self::PERIODS) ? $request->input('period') : 'any';
        $sort = in_array($request->input('sort'), ['newest', 'oldest', 'amount'], true) ? $request->input('sort') : 'newest';
        $search = trim((string) $request->input('search', ''));

        $counts = [
            'all'      => Order::count(),
            'approved' => Order::where('status', 'approved')->count(),
            'pending'  => Order::where('status', 'pending')->count(),
        ];

        // Revenue from paid orders, per currency (orders keep their own currency).
        $revenue = Order::where('status', 'approved')
            ->selectRaw('currency, SUM(paid_amount) as total, COUNT(*) as orders')
            ->groupBy('currency')->orderByDesc('total')->get();
        $revenueThisMonth = Order::where('status', 'approved')
            ->where('created_at', '>=', now()->startOfMonth())
            ->selectRaw('currency, SUM(paid_amount) as total')
            ->groupBy('currency')->orderByDesc('total')->get();

        $orders = Order::query()
            ->with(['customer', 'order_items.course:id,title'])
            ->withCount('order_items')
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->when($method !== '', fn ($q) => $q->where('payment_method', $method))
            ->when($period !== 'any', fn ($q) => $q->where('created_at', '>=', match ($period) {
                'today' => now()->startOfDay(),
                '7d'    => now()->subDays(7),
                '30d'   => now()->subDays(30),
                'month' => now()->startOfMonth(),
                'year'  => now()->startOfYear(),
            }))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('invoice_id', 'like', "%{$search}%")
                        ->orWhere('transaction_id', 'like', "%{$search}%")
                        ->orWhereHas('customer', fn ($c) => $c->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%"));
                });
            })
            ->when($sort === 'newest', fn ($q) => $q->latest())
            ->when($sort === 'oldest', fn ($q) => $q->oldest())
            ->when($sort === 'amount', fn ($q) => $q->orderByDesc('paid_amount'))
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.orders.index', [
            'pageTitle'        => 'CAITD | Orders',
            'orders'           => $orders,
            'counts'           => $counts,
            'revenue'          => $revenue,
            'revenueThisMonth' => $revenueThisMonth,
            'status'           => $status,
            'method'           => $method,
            'period'           => $period,
            'sort'             => $sort,
            'search'           => $search,
            'methods'          => self::METHODS,
            'periods'          => self::PERIODS,
            'hasFilters'       => $method !== '' || $period !== 'any' || $search !== '',
        ]);
    }

    public function show(Request $request, int $order_id)
    {
        $order = Order::with(['customer', 'order_items.course.instructor'])->findOrFail($order_id);

        return view('admin.pages.orders.show', [
            'pageTitle' => 'CAITD | Order #' . $order->invoice_id,
            'order'     => $order,
            'method'    => self::METHODS[$order->payment_method] ?? [ucfirst((string) $order->payment_method), 'ti-credit-card'],
        ]);
    }
}
