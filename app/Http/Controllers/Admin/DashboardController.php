<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $monthlyOrderSum = [];
        $monthlyOrderCount = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyOrderSum[$month] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');

            $monthlyOrderCount[$month] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }

        $data = [
            'pageTitle' => 'CAITD | Admin Dashboard',
            'todayOrder' => Order::whereDate('created_at', Carbon::today())->sum('total_amount'),
            'thisWeekOrder' => Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount'),
            'thisMonthOrder' => Order::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_amount'),
            'thisYearOrder' => Order::whereYear('created_at', Carbon::now()->year)->sum('total_amount'),
            'totalOrderCount' => Order::count(),
            'totalPendingCourse' => Course::where('is_approved', 'pending')->count(),
            'totalRejectedCourse' => Course::where('is_approved', 'rejected')->count(),
            'totalApprovedCourse' => Course::where('is_approved', 'approved')->count(),
            'totalCourseCount' => Course::count(),
            'monthlyOrderSum' => $monthlyOrderSum,
            'monthlyOrderCount' => $monthlyOrderCount,
            'recentCourses' => Course::latest()->take(5)->get(),
            'recentBlogs' => Blog::latest()->take(5)->get(),
            'recentOrders' => Order::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }

}
