<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Illuminate\Support\Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'EduCore | Course Language'
        ];
        $courseLanguages = CourseLanguage::paginate(15);
        $data['courseLanguages'] = $courseLanguages;

        return view('admin.pages.course.course-languages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [
            'pageTitle' => 'EduCore | Create Course Language'
        ];
        return view('admin.pages.course.course-languages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_languages',
        ]);
        $courseLanguage = new CourseLanguage();
        $courseLanguage->name = $request->name;
        $courseLanguage->slug = Str::slug($request->name);
        $courseLanguage->save();
        notyf()->success('Course Language Created Successfully');
        return redirect()->route('admin.course-languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLanguage $course_language)
    {
        return view('admin.pages.course.course-languages.edit', [
            'pageTitle' => 'EduCore | Edit Course Language',
            'course_language' => $course_language
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_languages,name,' . $id,
        ]);
        $courseLanguage = CourseLanguage::findOrFail($id);
        $courseLanguage->name = $request->name;
        $courseLanguage->save();
        notyf()->success('Course Language Updated Successfully');
        return redirect()->route('admin.course-languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLanguage $course_language)
    {
        try {
            $course_language->delete();
            notyf()->success('Deleted Successfully!');
            return response()->json([
                'message' => 'Deleted Successfully!',
            ], 200);
        } catch (Exception $e) {
            logger($e);
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
