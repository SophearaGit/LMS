<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{

    public function exportExcel()
    {

        $report = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->select(
                'courses.title as course_name',
                DB::raw('SUM(order_items.qty) as total_students'),
                DB::raw('SUM(order_items.price * order_items.qty) as total_revenue')
            )
            ->where('orders.status', 'approved') // optional but recommended
            ->groupBy('courses.id', 'courses.title')
            ->whereYear('orders.created_at', now()->year)
            ->get();

        // Create Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Course');
        $sheet->setCellValue('B1', 'Total Students');
        $sheet->setCellValue('C1', 'Total Revenue');

        // data
        $row = 2;
        foreach ($report as $item) {
            $sheet->setCellValue('A' . $row, $item->course_name);
            $sheet->setCellValue('B' . $row, $item->total_students);
            $sheet->setCellValue('C' . $row, $item->total_revenue);
            $row++;
        }

        // File name
        $fileName = 'course-sales.xlsx';

        // Output
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }


    public function exportPdf(Request $request)
    {
        $year = $request->year ?? now()->year;

        $report = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->whereYear('orders.created_at', $year)
            ->where('orders.status', 'approved')
            ->select(
                'courses.title as course_name',
                DB::raw('SUM(order_items.qty) as total_students'),
                DB::raw('SUM(order_items.price * order_items.qty) as revenue')
            )
            ->groupBy('courses.id', 'courses.title')
            ->get();

        $pdf = Pdf::loadView('admin.reports.course-sales-pdf' , compact('report', 'year'));

        return $pdf->download("course-sales-$year.pdf");
    }




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
            'recentBoughtCourses' => Course::whereHas('orderItems.order', function ($query) {
                $query->where('status', 'approved');
            })
                ->with(['orderItems.order'])
                ->withSum([
                    'orderItems as total_revenue' => function ($query) {
                        $query->whereHas('order', function ($q) {
                            $q->where('status', 'approved');
                        });
                    }
                ], DB::raw('price * qty'))
                ->latest('id')
                ->take(5)
                ->get(),

        ];

        return view('admin.dashboard', $data);
    }





}
