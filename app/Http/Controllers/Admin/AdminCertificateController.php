<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollments;
use App\Models\MakeHistory;
use Symfony\Component\HttpFoundation\Request;
class AdminCertificateController extends Controller
{
    public function completedStudents(Request $request)
    {
        $query = Enrollments::with([
            'user',
            'course',
            'course.instructor',
        ]);
        // Search Student
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        // Filter Course
        if ($request->filled('course')) {
            $query->where('course_id', $request->course);
        }
        // Filter Instructor
        if ($request->filled('instructor')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('instructor_id', $request->instructor);
            });
        }
        $students = $query->get()->filter(function ($enrollment) {
            $totalLessons = $enrollment->course->lessons()->count();
            $completedLessons = MakeHistory::where('user_id', $enrollment->user_id)
                ->where('course_id', $enrollment->course_id)
                ->where('is_completed', true)
                ->count();
            return $totalLessons > 0 && $completedLessons >= $totalLessons;
        });
        // Attach Certificate
        $students = $students->map(function ($student) {
            $student->certificate = Certificate::where('user_id', $student->user_id)
                ->where('course_id', $student->course_id)
                ->first();
            return $student;
        });
        return view('admin.pages.certificates.completed-students', [
            'pageTitle' => 'Completed Students - C.A.I.T',
            'students' => $students,
            'courses' => Course::orderBy('title')->get(),
            'instructors' => User::where('role', 'instructor')
                ->orderBy('name')
                ->get(),
            'completedStudents' => $students->count(),
            'completedCourses' => $students->groupBy('course_id')->count(),
            'issuedCertificates' => Certificate::count(),
            'certificateDownloads' => Certificate::sum('download_count'),
        ]);
    }
    public function issued()
    {
        return view('admin.certificates.issued');
    }
}
