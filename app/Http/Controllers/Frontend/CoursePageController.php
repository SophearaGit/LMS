<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CoursePageController extends Controller
{
    public function getCoursePage()
    {
        $data = [
            'pageTitle' => 'Edu | Course',
            'courses' => Course::where('is_approved', 'approved')
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->paginate(12),
        ];
        return view('front.pages.course-page', $data);
    }
    public function getcoursedetailpage(string $slug)
    {
        $data = [
            'pageTitle' => 'Edu | Course',
            'course' => Course::where('slug', $slug)
                ->where('is_approved', 'approved')
                ->where('status', 'active')
                ->firstOrFail(),
        ];
        return view('front.pages.course-detail-page', $data);
    }

}
