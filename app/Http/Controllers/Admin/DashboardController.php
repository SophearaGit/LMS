<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollments;
use App\Models\MakeHistory;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Models\Withdraw;
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
        $now = Carbon::now();
        $thisMonth = $now->copy()->startOfMonth();
        $lastMonth = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $countBetween = fn ($query, $from, $to) => (clone $query)->whereBetween('created_at', [$from, $to])->count();

        // People
        $studentQuery = User::where('role', 'student');
        $students = [
            'total' => (clone $studentQuery)->count(),
            'this_month' => $countBetween($studentQuery, $thisMonth, $now),
            'last_month' => $countBetween($studentQuery, $lastMonth, $thisMonth),
        ];
        $activeLearners = MakeHistory::where('updated_at', '>=', $now->copy()->subDays(30))
            ->distinct()->count('user_id');

        // Enrolments and certificates
        $enrollQuery = Enrollments::query();
        $enrollments = [
            'total' => Enrollments::count(),
            'this_month' => $countBetween($enrollQuery, $thisMonth, $now),
            'last_month' => $countBetween($enrollQuery, $lastMonth, $thisMonth),
        ];
        $certificates = [
            'total' => Certificate::count(),
            'this_month' => Certificate::whereBetween('issued_at', [$thisMonth, $now])->count(),
            'last_month' => Certificate::whereBetween('issued_at', [$lastMonth, $thisMonth])->count(),
        ];

        // Last 12 months: enrolments and certificates per month
        $trendStart = $now->copy()->startOfMonth()->subMonths(11);
        $months = collect(range(0, 11))->map(fn ($i) => $trendStart->copy()->addMonths($i));
        $enrolPerMonth = Enrollments::where('created_at', '>=', $trendStart)->pluck('created_at')
            ->countBy(fn ($d) => Carbon::parse($d)->format('Y-m'));
        $certPerMonth = Certificate::where('issued_at', '>=', $trendStart)->pluck('issued_at')
            ->countBy(fn ($d) => Carbon::parse($d)->format('Y-m'));
        $trend = [
            'labels' => $months->map(fn ($m) => $m->format('M Y'))->values(),
            'enrollments' => $months->map(fn ($m) => $enrolPerMonth[$m->format('Y-m')] ?? 0)->values(),
            'certificates' => $months->map(fn ($m) => $certPerMonth[$m->format('Y-m')] ?? 0)->values(),
        ];

        // Lesson progress of every enrolment
        $lessonTotals = DB::table('course_chapter_lessons')->whereNull('deleted_at')
            ->select('course_id', DB::raw('COUNT(*) as total'))->groupBy('course_id')
            ->pluck('total', 'course_id');
        $lessonsDone = DB::table('make_histories')->where('is_completed', 1)
            ->select('user_id', 'course_id', DB::raw('COUNT(DISTINCT lesson_id) as done'))
            ->groupBy('user_id', 'course_id')->get()
            ->keyBy(fn ($row) => $row->user_id . '-' . $row->course_id);
        $progress = ['not_started' => 0, 'in_progress' => 0, 'completed' => 0];
        $perCourse = [];
        foreach (Enrollments::select('user_id', 'course_id')->get() as $enrolment) {
            $total = (int) ($lessonTotals[$enrolment->course_id] ?? 0);
            $done = min((int) optional($lessonsDone->get($enrolment->user_id . '-' . $enrolment->course_id))->done, $total);
            $percent = $total > 0 ? $done / $total * 100 : 0;
            $progress[$percent >= 100 ? 'completed' : ($done > 0 ? 'in_progress' : 'not_started')]++;
            $perCourse[$enrolment->course_id]['sum'] = ($perCourse[$enrolment->course_id]['sum'] ?? 0) + $percent;
            $perCourse[$enrolment->course_id]['completed'] = ($perCourse[$enrolment->course_id]['completed'] ?? 0) + ($percent >= 100 ? 1 : 0);
        }

        // Courses with the most students
        $topCourses = Course::with('instructor:id,name')
            ->withCount('enrollments')
            ->withAvg('reviews', 'rating')
            ->where('is_approved', 'approved')
            ->orderByDesc('enrollments_count')
            ->take(6)->get()
            ->each(function ($course) use ($perCourse) {
                $students = max($course->enrollments_count, 1);
                $course->avg_progress = round(($perCourse[$course->id]['sum'] ?? 0) / $students);
                $course->completed_count = $perCourse[$course->id]['completed'] ?? 0;
            });

        // Things waiting for a decision
        $attention = [
            ['label' => 'Courses waiting for approval', 'icon' => 'ti-book', 'count' => Course::where('is_approved', 'pending')->count(), 'url' => route('admin.courses.index', ['status' => 'pending'])],
            ['label' => 'Instructor applications', 'icon' => 'ti-user-check', 'count' => User::where('approval_status', 'pending')->count(), 'url' => route('admin.instructor-requests.index', ['status' => 'pending'])],
            ['label' => 'Reviews to moderate', 'icon' => 'ti-message-star', 'count' => Review::where('status', 0)->count(), 'url' => route('admin.review.index')],
            ['label' => 'Payout requests', 'icon' => 'ti-cash', 'count' => Withdraw::where('status', 'pending')->count(), 'url' => route('admin.withdraw-request.index')],
            ['label' => 'Unpaid orders', 'icon' => 'ti-receipt', 'count' => Order::where('status', 'pending')->count(), 'url' => route('admin.orders.index')],
        ];

        // Revenue (approved orders only)
        $paid = Order::where('status', 'approved');
        $revenue = [
            'this_month' => (clone $paid)->whereBetween('created_at', [$thisMonth, $now])->sum('total_amount'),
            'last_month' => (clone $paid)->whereBetween('created_at', [$lastMonth, $thisMonth])->sum('total_amount'),
            'this_year' => (clone $paid)->whereYear('created_at', $now->year)->sum('total_amount'),
            'paid_orders' => (clone $paid)->count(),
        ];

        $data = [
            'pageTitle' => 'CAITD | Admin Dashboard',
            'adminName' => optional(auth('admin')->user())->name,
            'students' => $students,
            'instructorCount' => User::where('role', 'instructor')->count(),
            'activeLearners' => $activeLearners,
            'enrollments' => $enrollments,
            'certificates' => $certificates,
            'courseCounts' => [
                'published' => Course::where('is_approved', 'approved')->where('status', 'active')->count(),
                'total' => Course::count(),
            ],
            'rating' => [
                'average' => round((float) Review::where('status', 1)->avg('rating'), 1),
                'count' => Review::where('status', 1)->count(),
            ],
            'trend' => $trend,
            'progress' => $progress,
            'topCourses' => $topCourses,
            'attention' => $attention,
            'revenue' => $revenue,
            'latestEnrollments' => Enrollments::with(['user:id,name', 'course:id,title,slug'])->latest()->take(6)->get(),
            'latestCertificates' => Certificate::with(['user:id,name', 'course:id,title'])->latest('issued_at')->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
