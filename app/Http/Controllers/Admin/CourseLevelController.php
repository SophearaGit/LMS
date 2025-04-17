<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Exception;
use Illuminate\Http\Request;
use Str;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'EduCore | Course Level'
        ];
        $courseLevels = CourseLevel::paginate(15);
        $data['courseLevels'] = $courseLevels;

        return view('admin.pages.course.course-levels.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'EduCore | Create Course Level'
        ];
        return view('admin.pages.course.course-levels.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_levels',
        ]);
        $courseLevel = new CourseLevel();
        $courseLevel->name = $request->name;
        $courseLevel->slug = Str::slug($request->name);
        $courseLevel->save();
        notyf()->success('Course Level Created Successfully');
        return redirect()->route('admin.course-levels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseLevel $courseLevel)
    {
        return view('admin.pages.course.course-levels.edit', [
            'pageTitle' => 'EduCore | Edit Course Level',
            'courseLevel' => $courseLevel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_levels,name,' . $id,
        ]);
        $courseLevel = CourseLevel::findOrFail($id);
        $courseLevel->name = $request->name;
        $courseLevel->slug = Str::slug($request->name);
        $courseLevel->save();
        notyf()->success('Course Level Updated Successfully');
        return redirect()->route('admin.course-levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseLevel $courseLevel)
    {
        try {
            $courseLevel->delete();
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
