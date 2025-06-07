<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LatestCourseSectionUpdateRequest;
use App\Models\CourseCategory;
use App\Models\LatestCourseSection;
use Illuminate\Http\Request;

class LatestCourseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Latest Course Section',
            'categories_for_select' => CourseCategory::all(),
            'latestCourseSection' => LatestCourseSection::first(),
        ];
        return view('admin.pages.section.latestCourses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LatestCourseSectionUpdateRequest $request)
    {
        LatestCourseSection::updateOrCreate(
            ['id' => 1],
            $request->validated()
        );
        notyf()->success('Latest Course Section updated successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
