<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FeaturedInstructorSection;
use App\Models\User;
use App\Traites\FileUpload;
use Illuminate\Http\Request;

class FeaturedInstructorSectionController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Featured Instructor Section',
            'instructors' => User::where('role', 'instructor')
                ->where('approval_status', 'approved')
                ->latest()
                ->get(),
        ];
        $featuredInstructorSectionItems = FeaturedInstructorSection::first();
        $selectedCourses = json_decode($featuredInstructorSectionItems?->featured_courses);
        $selectedInstructorCourses = Course::select(['id', 'title'])
            ->where('instructor_id',$featuredInstructorSectionItems?->instructor_id )->get();
        return view(
            'admin.pages.section.featured-instructor-section.index',
            compact('featuredInstructorSectionItems', 'selectedCourses', 'selectedInstructorCourses'),
            $data,
        );
    }

    public function getInstructorCourses(string $instructor_id)
    {
        $instructorCourses = Course::select(['id', 'title'])->where('instructor_id', $instructor_id)
            ->where('is_approved', 'approved')
            ->where('status', 'active')
            ->latest()
            ->get();
        return response(['instructorCourses' => $instructorCourses]);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|url|max:255',
            'instructor_id' => 'required|exists:users,id',
            'featured_courses' => 'required|array',
            'featured_courses.*' => 'exists:courses,id',
            'instructor_image' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
        ]);

        $validatedData['featured_courses'] = json_encode($validatedData['featured_courses']);

        if ($request->hasFile('instructor_image')) {
            $image = $this->uploadFile($request->file('instructor_image'));
            if (!$request->old_image == '') {
                $this->deleteIfImageExist($request->old_image);
            }
            $validatedData['instructor_image'] = $image;
        }

        FeaturedInstructorSection::updateOrCreate(
            ['id' => 1], // Assuming you want to update the first record
            $validatedData
        );

        notyf()->success('Featured Instructor Section updated successfully.');
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
