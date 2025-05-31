<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLessons;
use App\Models\Enrollments;
use App\Models\MakeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class EnrolledCourseController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Enrolled Course',
            'enrolledCourses' => Enrollments::with('course')->where('user_id', Auth::user()->id)->get(),
        ];
        return view('front.pages.student.enrolled-courses.index', $data);
    }

    public function enrolledCourseVideos(string $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        if (!Enrollments::where('user_id', Auth::user()->id)->where('course_id', $course->id)->where('has_access', 1)->exists())
            return abort(404);
        $data = [
            'pageTitle' => 'CAIDT | Enrolled Course Videos',
            'course' => $course,
            'lastWatchHistory' => MakeHistory::where(['user_id' => Auth::user()->id, 'course_id' => $course->id])
                ->orderByDesc('updated_at')->first(),
            'lessonCount' => CourseChapterLessons::where('course_id', $course->id)->count(),
            'finishCount' => MakeHistory::where('user_id', Auth::user()->id)
                ->where('course_id', $course->id)
                ->where('is_completed', 1)
                ->count(),
        ];
        return view('front.pages.student.enrolled-courses.course-videos', $data);
    }

    // getLessonContent
    public function getLessonContent(Request $request)
    {
        $data = [
            'pageTitle' => 'CAIDT | Enrolled Course Videos',
            'lesson' => CourseChapterLessons::where('course_id', $request->course_id)
                ->where('chapter_id', $request->chapter_id)
                ->where('id', $request->lesson_id)
                ->firstOrFail(),
        ];
        return response()->json([
            'data' => $data['lesson'],
        ]);
    }

    public function updateWatchHistory(Request $request)
    {
        MakeHistory::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'lesson_id' => $request->lesson_id,
            ],
        )->touch();
    }

    public function updateLessonCompletion(Request $request)
    {
        MakeHistory::withoutTimestamps(function () use ($request) {
            MakeHistory::updateOrCreate(
                [
                    'user_id' => Auth::user()->id,
                    'course_id' => $request->course_id,
                    'chapter_id' => $request->chapter_id,
                    'lesson_id' => $request->lesson_id,
                ],
                ['is_completed' => $request->is_completed]
            );
        });
        return response()->json([
            'message' => 'Updated successfully!',
        ]);
    }

    // downloadFile
    public function downloadFile(string $id)
    {
        $lesson = CourseChapterLessons::findOrFail($id);
        return response()->download(public_path($lesson->file_path));
    }




}
