<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;
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
            'pageTitle' => 'EduCore | Course Category',
            'courseCategories' => CourseCategory::whereNull('parent_id')->paginate(15),
        ];
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
        notyf()->success('Created Successfully');
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
    public function update(CourseCategoryUpdateRequest $request, CourseCategory $course_category)
    {
        $category = $course_category;
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteIfImageExist($category->image);
            $category->image = $imagePath;
        }
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = Str::slug($request->name);
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();
        notyf()->success('Updated Successfully');
        return redirect()->route('admin.course-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category)
    {
        if (CourseCategory::where('parent_id', $course_category->id)->exists()) {
            return response([
                'message' => 'This category has subcategories. Please delete them first.'
            ], 422);
        }
        try {
            $this->deleteIfImageExist($course_category->image);
            $course_category->delete();
            notyf()->success('Deleted Successfully!');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);
        } catch (\Exception $e) {
            logger($e);
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
