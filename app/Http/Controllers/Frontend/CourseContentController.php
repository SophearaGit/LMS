<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    public function createChapterModal(string $course_id)
    {
        return view('front.pages.instructor.course.components.partials.course-chapter-modal', compact('course_id'))->render();
    }

    public function storeChapterModal(Request $request, string $course_id)
    {
        $request->validate([
            'title' => 'required|max:255',
            // 'course_id' => 'required|integer',
        ]);
        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $course_id;
        $chapter->instructor_id = Auth::user()->id;
        $chapter->order = CourseChapter::where('course_id', $course_id)->count() + 1;
        $chapter->save();

        return redirect()->back();
    }

}
