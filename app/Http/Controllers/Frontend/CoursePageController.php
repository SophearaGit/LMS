<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Models\Enrollments;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursePageController extends Controller
{
    public function getCoursePage(Request $request)
    {
        $data = [
            'pageTitle' => 'CAITD | Course',
            'courses' => Course::where('is_approved', 'approved')
                ->where('status', 'active')
                ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                })
                ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                    if (is_array($request->catgory)) {
                        $query->whereIn('category_id', $request->category);
                    } else {
                        $query->where('category_id', $request->category);
                    }
                })
                ->when($request->has('level') && $request->filled('level'), function ($query) use ($request) {
                    $query->whereIn('course_level_id', $request->level);
                })
                ->when($request->has('language') && $request->filled('language'), function ($query) use ($request) {
                    $query->whereIn('course_language_id', $request->language);
                })
                ->when($request->has('from') && $request->has('to') && $request->filled('from') && $request->filled('to'), function ($query) use ($request) {
                    $query->whereBetween('price', [$request->from, $request->to]);
                })
                // order_by=asc
                ->orderBy('id', $request->filled('order_by') ? $request->order_by : 'desc')
                ->paginate(12),
            'categories' => CourseCategory::with('subCategories')
                ->where('status', 1)
                ->whereNull('parent_id')
                ->latest()->get(),
            'levels' => CourseLevel::with('courses')->get(),
            'languages' => CourseLanguage::with('courses')->get(),
        ];
        return view('front.pages.course-page', $data);
    }
    public function getcoursedetailpage(string $slug)
    {
        $data = [
            'pageTitle' => 'CAITD | Course',
            'course' => Course::with('reviews')->where('slug', $slug)
                ->where('is_approved', 'approved')
                ->where('status', 'active')
                ->firstOrFail(),
            'reviewsApproved' => Review::where('status', 1)->latest()->paginate(10),
        ];
        return view('front.pages.course-detail-page', $data);
    }

    public function sendReview(Request $request)
    {
        // dd($request->all());

        $request->validate(rules: [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
            'course_id' => 'required|exists:courses,id',
        ]);

        $checkPurchase = Enrollments::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->exists();

        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->where('status', 1)
            ->exists();

        if (!$checkPurchase) {
            notyf()->error('You must purchase the course before submitting a review.');
            return redirect()->back();
        }

        if ($alreadyReviewed) {
            notyf()->error('You have already submitted a review for this course.');
            return redirect()->back();
        }

        // $review = new Review();
        // $review->user_id = Auth::id();
        // $review->course_id = $request->course_id;
        // $review->review = $request->comment;
        // $review->rating = $request->rating;
        // $review->save();

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $request->course_id,
            ],
            [
                'review' => $request->comment,
                'rating' => $request->rating,
                'status' => 0,
            ]
        );

        notyf()->success('Thank you for your review! It will be published after approval.');
        return redirect()->back();
    }

}
