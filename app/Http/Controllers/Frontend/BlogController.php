<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'CAIT | Blog',
            'blogs' => Blog::where('status', 1)
                ->when($request->filled('search'), function ($query) use ($request) {
                    $search = $request->get('search');
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->when($request->filled('category'), function ($query) use ($request) {
                    $slug = $request->get('category');
                    $query->whereHas('blog_category', function ($q) use ($slug) {
                        $q->where('slug', $slug);
                    });
                })
                ->paginate(6),
        ];
        return view('front.pages.blog', $data);
    }

    public function getBlogDetail(string $slug)
    {
        $data = [
            'pageTitle' => 'CAIT | Blog Detail',
            'blog' => Blog::with(['blog_category', 'blog_author', 'comments'])->where('slug', $slug)->firstOrFail(),
            'recentBlogPosts' => Blog::where('status', 1)->where('slug', '!=', $slug)->latest()->take(3)->get(),
            'blogCategories' => BlogCategory::withCount('blogs')
                ->where('status', 1)
                ->whereHas('blogs', function ($query) {
                    $query->where('status', 1);
                })
                ->latest()->take(8)->get(),
        ];

        return view('front.pages.blog-detail', $data);
    }

    public function storeComment(Request $request, string $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $blog = Blog::findOrFail($id);

        $blog->comments()->create([
            'comment' => $request->input('comment'),
            'user_id' => Auth::id(),
            'blog_id' => $blog->id,
        ]);

        notyf()->success('Comment added successfully!');
        return redirect()->back();
    }

}
