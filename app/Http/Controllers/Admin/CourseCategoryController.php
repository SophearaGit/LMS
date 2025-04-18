<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Models\CourseCategory;
use App\Traites\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'EduCore | Course Category'
        ];
        $courseCategories = CourseCategory::paginate(15);
        $data['courseCategories'] = $courseCategories;
        return view('admin.pages.course.course-categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'EduCore | Course Category'
        ];
        return view('admin.pages.course.course-categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request)
    {
        $imagePath = $this->uploadFile($request->file('image'));
        $category = new CourseCategory();
        $category->image = $imagePath;
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = Str::slug($request->name);
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();
        notyf()->success('Course Category Created Successfully');
        return redirect()->route('admin.course-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $courseCategory)
    {
        $data = [
            'pageTitle' => 'EduCore | Course Category',
            'courseCategory' => $courseCategory
        ];
        return view('admin.pages.course.course-categories.edit', $data);
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
