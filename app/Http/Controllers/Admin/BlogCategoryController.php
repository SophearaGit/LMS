<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Blog Categories',
            'blog_categories' => BlogCategory::paginate(10),
        ];
        return view('admin.pages.blog.blog-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Blog Category',
        ];
        return view('admin.pages.blog.blog-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'status' => 'boolean',
        ]);

        $blog_category = new BlogCategory();
        $blog_category->name = $request->name;
        $blog_category->slug = Str::slug($request->name);
        $blog_category->status = $request->status ?? 0;
        $blog_category->save();

        notyf()->success('Blog Category created successfully.');
        return to_route('admin.blog-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blog_category)
    {
        $data = [
            'pageTitle' => 'CAITD | Edit Blog Category',
            'blog_category' => $blog_category,
        ];
        return view('admin.pages.blog.blog-category.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blog_category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blog_category->id,
            'status' => 'boolean',
        ]);

        $blog_category->name = $request->name;
        $blog_category->slug = Str::slug($request->name);
        $blog_category->status = $request->status ?? 0;
        $blog_category->save();

        notyf()->success('Blog Category updated successfully.');
        return to_route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blog_category)
    {
        try {
            $blog_category->delete();
            notyf()->success('Deleted Successfully!');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);
        } catch (\Exception $e) {
            logger($e);
            notyf()->error('Something went wrong');
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
