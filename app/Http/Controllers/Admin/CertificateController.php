<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Models\Course;
use App\Models\CourseChapterLessons;
use App\Models\MakeHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download(Course $course)
    {
        $lessonCount = CourseChapterLessons::where('course_id', $course->id)->count();

        $finishLessonCount = MakeHistory::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('is_completed', 1)
            ->count();

        if ($lessonCount !== $finishLessonCount) return abort(404);

        $data = [
            'pageTitle' => 'CAITD | Certificate',
            'certificate' => CertificateBuilder::first(),
            'certificateItems' => CertificateBuilderItem::all(),
        ];

        $html = view('front.pages.student.enrolled-courses.certificate', $data)->render();

        // Replace placeholder variables in the HTML with actual values
        $html = str_replace('[student_name]', Auth::user()->name, $html);
        $html = str_replace('[course_name]', $course->title, $html);
        $html = str_replace('[date]', date('d-m-y'), $html);
        $html = str_replace('[plateform_name]', 'CAITD', $html);
        $html = str_replace('[instructor_name]', $course->instructor->name, $html);

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

}
