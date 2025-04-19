<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryUpdateRequest;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traites\FileUpload;
use Exception;

class CourseSubCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(
        CourseCategory $courseCategory
    ) {
        $data = [
            'pageTitle' => 'Educore | Course Sub Categories',
            'courseCategory' => $courseCategory,
            'subCategories' => CourseCategory::where('parent_id', $courseCategory->id)->paginate(15),
        ];
        return view('admin.pages.course.course-sub-categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CourseCategory $courseCategory)
    {
        $data = [
            'pageTitle' => 'Educore | Create Course Sub Category',
            'courseCategory' => $courseCategory,
        ];
        return view('admin.pages.course.course-sub-categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSubCategoryStoreRequest $request, CourseCategory $courseCategory)
    {
        $category = new CourseCategory();
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $category->image = $imagePath;
        }
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $courseCategory->id;
        $category->show_at_trending = $request->show_at_trending ?? 0;
        $category->status = $request->status ?? 0;
        $category->save();
        notyf()->success('Created Successfully');
        return redirect()->route('admin.course-sub-categories.index', $courseCategory->id);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        CourseCategory $course_category,
        CourseCategory $course_sub_category,
    ) {
        $data = [
            'pageTitle' => 'Educore | Edit Course Sub Category',
            'course_category' => $course_category,
            'course_sub_category' => $course_sub_category,
        ];
        return view('admin.pages.course.course-sub-categories.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(
        CourseSubCategoryUpdateRequest $request,
        CourseCategory $course_category,
        CourseCategory $course_sub_category,
    ) {
        $category = $course_sub_category;
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
        return redirect()->route('admin.course-sub-categories.index', $course_category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        CourseCategory $course_category,
        CourseCategory $course_sub_category,
    ) {
        try {
            $this->deleteIfImageExist($course_sub_category->image);
            $course_sub_category->delete();
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
