<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{

    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Instructor-Dashboard',
            'rejectedCourses' => Course::where([
                'instructor_id' => Auth::user()->id,
                'is_approved' => 'rejected',
            ])->count(),
            'pendingCourses' => Course::where([
                'instructor_id' => Auth::user()->id,
                'is_approved' => 'pending',
            ])->count(),
            'approvedCourses' => Course::where([
                'instructor_id' => Auth::user()->id,
                'is_approved' => 'approved',
            ])->count(),
            'orderItems' => OrderItem::whereHas('course', function ($query) {
                $query->where('instructor_id', Auth::user()->id);
            })->latest()->paginate(5),
        ];
        return view('front.pages.instructor.index', $data);
    }

}
