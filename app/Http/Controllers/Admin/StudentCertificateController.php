<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Models\Course;
use App\Models\CourseChapterLessons;
use App\Models\MakeHistory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
class StudentCertificateController extends Controller
{
    public function download(Course $course, User $user = null)
    {
        $user = $user ?? Auth::user();
        $lessonCount = CourseChapterLessons::where('course_id', $course->id)->count();
        $finishLessonCount = MakeHistory::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('is_completed', 1)
            ->count();
        if ($lessonCount !== $finishLessonCount) {
            abort(404);
        }
        $certificate = CertificateBuilder::first();
        if (!$certificate) {
            abort(404, 'Certificate template not found.');
        }
        $certificateItems = CertificateBuilderItem::all();
        $data = [
            'pageTitle' => 'CAITD | Certificate',
            'certificate' => $certificate,
            'certificateItems' => $certificateItems,
        ];
        $html = view(
            'front.pages.student.enrolled-courses.certificate',
            $data
        )->render();
        $html = str_replace('[student_name]', $user->name, $html);
        $html = str_replace('[course_name]', $course->title, $html);
        $html = str_replace('[date]', now()->format('d-m-Y'), $html);
        $html = str_replace('[plateform_name]', 'CAITD', $html);
        $html = str_replace('[instructor_name]', $course->instructor->name ?? '-', $html);
        $pdf = Pdf::loadHTML($html)
            ->setPaper('a4', 'landscape');
        return $pdf->stream(
            'Certificate-' .
            str_replace(' ', '-', $user->name) .
            '-' .
            str_replace(' ', '-', $course->title) .
            '.pdf'
        );
    }
}
