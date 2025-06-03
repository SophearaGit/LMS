<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Feature;
use App\Models\Hero;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Homepage',
            'heroItems' => Hero::first(),
            'featureItems' => Feature::all(),
            'featuredCategories' => CourseCategory::withCount([
                'subCategories as active_course_count' => function ($query) {
                    $query->whereHas('courses', function ($query) {
                        $query->where(['is_approved' => 'approved', 'status' => 'active']);
                    });
                }
            ])->where(['parent_id' => null, 'show_at_trending' => 1])->limit(12)->get(),
            'aboutUsSectionItems' => AboutUsSection::first(),
        ];
        return view('front.pages.index', $data);
    }

}



