<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseChapter;
use App\Models\CourseChapterLessons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        ]);

        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $course_id;
        $chapter->instructor_id = Auth::user()->id;
        $chapter->order = CourseChapter::where('course_id', $course_id)->count() + 1;
        $chapter->save();

        return redirect()->back();
    }

    public function createLessonModal(Request $request)
    {
        $data = [
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
        ];
        return view('front.pages.instructor.course.components.partials.chapter-lesson-modal', $data)->render();
    }

    public function storeLessonModal(Request $request)
    {
        // dd($request);
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'storage' => ['required', 'string'],
            'file_type' => ['required', 'in:video,audio,doc,file,pdf'],
            'duration' => ['required'],
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'description' => ['required'],
        ];
        if ($request->filled('file_path')) {
            $rules['file_path'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }

        $request->validate($rules);
        $lesson = new CourseChapterLessons();
        $lesson->instructor_id = Auth::user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->storage;
        $lesson->file_path = $request->filled('file_path') ? $request->file_path : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->has('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->has('downloadable') ? 1 : 0;
        $lesson->order = CourseChapterLessons::where('chapter_id', $request->chapter_id)->count() + 1;
        $lesson->description = $request->description;
        $lesson->save();

        notyf()->success('Created successfully!');

        return redirect()->back();
    }

    public function editLessonModal(Request $request)
    {
        $data = [
            'on_edit' => true,
            'course_id' => $request->course_id,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'lesson' => CourseChapterLessons::where(column: [
                'instructor_id' => Auth::user()->id,
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'id' => $request->lesson_id,
            ])->first(),
        ];
        return view('front.pages.instructor.course.components.partials.chapter-lesson-modal', $data)->render();
    }

    public function updateLessonModal(Request $request, string $lesson_id)
    {
        // dd($request->all());
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'storage' => ['required', 'string'],
            'file_type' => ['required', 'in:video,audio,doc,file,pdf'],
            'duration' => ['required'],
            'is_preview' => ['nullable', 'boolean'],
            'downloadable' => ['nullable', 'boolean'],
            'description' => ['required'],
        ];
        if ($request->filled('file_path')) {
            $rules['file_path'] = ['required'];
        } else {
            $rules['url'] = ['required'];
        }
        $request->validate($rules);

        $lesson = CourseChapterLessons::findOrFail($lesson_id);
        $lesson->instructor_id = Auth::user()->id;
        $lesson->course_id = $request->course_id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title);
        $lesson->storage = $request->storage;
        $lesson->file_path = $request->filled('file_path') ? $request->file_path : $request->url;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration;
        $lesson->is_preview = $request->has('is_preview') ? 1 : 0;
        $lesson->downloadable = $request->has('downloadable') ? 1 : 0;
        $lesson->description = $request->description;
        $lesson->save();

        notyf()->success('Update successfully!');

        return redirect()->back();
    }



}
