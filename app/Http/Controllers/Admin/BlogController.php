<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traites\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Blog',
            'blogs' => Blog::with('blog_category')->paginate(10),
        ];
        return view('admin.pages.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAITD | Create Blog',
            'blog_categories' => BlogCategory::all(),
        ];
        return view('admin.pages.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
        }

        $blog = new Blog();
        $blog->user_id = Auth::user()->id;
        $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        $blog->description = $request->description;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->status = $request->status ?? 0;
        $blog->save();

        notyf()->success('Blog created successfully.');
        return to_route('admin.blog.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $data = [
            'pageTitle' => 'CAITD | Edit Blog',
            'blog' => $blog,
            'blog_categories' => BlogCategory::all(),
        ];
        return view('admin.pages.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $this->deleteIfImageExist($blog->image);
            $blog->image = $imagePath;
        }

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title, '-');
        $blog->description = $request->description;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->status = $request->status ?? 0;
        $blog->save();

        notyf()->success('Blog updated successfully.');
        return to_route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Blog $blog)
    {
        try {
            $this->deleteIfImageExist($blog->image);
            $blog->delete();
            notyf()->success('Deleted successfully.');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);
        } catch (\Exception $e) {
            logger($e);
            notyf()->error('Something went wrong.');
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
