<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\BecomeInstructorSection;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Counter;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Feature;
use App\Models\FeaturedInstructorSection;
use App\Models\Hero;
use App\Models\LatestCourseSection;
use App\Models\NewsLetter;
use App\Models\Testimonial;
use App\Models\TopBar;
use App\Models\VideoSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredInstructorItems = FeaturedInstructorSection::first();

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
            'latestCourses' => LatestCourseSection::first(),
            'becomeInstructorSectionItems' => BecomeInstructorSection::first(),
            'videoSectionItems' => VideoSection::first(),
            'brandSecitonItems' => Brand::where('status', 1)->get(),
            'featuredInstructorItems' => $featuredInstructorItems,
            'testimonials' => Testimonial::all(),
            // 'topBarItems' => TopBar::first(),
        ];

        $featuredInstructorCourses = Course::whereIn('id', json_decode($featuredInstructorItems?->featured_courses))->get();

        return view('front.pages.index', $data, compact(
            'featuredInstructorCourses'
        ));
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:news_letters,email',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'Email already subscribed to our newsletter.',
            ]
        );

        $data = $request->only('email');
        NewsLetter::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'You have successfully subscribed to our newsletter.',
        ]);
    }

    public function getAboutUs()
    {
        $data = [
            'pageTitle' => 'CAITD | About Us',
            'aboutUsSectionItems' => AboutUsSection::first(),
            'testimonials' => Testimonial::all(),
            'counterItems' => Counter::first(),
        ];
        return view('front.pages.about-us', $data);
    }

}



