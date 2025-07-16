<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIT | Blog',
            'blogs' => Blog::where('status', 1)->paginate(6),
        ];
        return view('front.pages.blog', $data);
    }

    public function getBlogDetail($slug)
    {
        $data = [
            'pageTitle' => 'CAIT | Blog Detail',
            'blog' => Blog::with(['blog_category', 'blog_author'])->where('slug', $slug)->firstOrFail(),
        ];
        return view('front.pages.blog-detail', $data);
    }
}
