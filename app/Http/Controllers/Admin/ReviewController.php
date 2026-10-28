<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Course reviews. status 0 = waiting for approval (not shown on the site), 1 = published.
     */
    public function index(Request $request)
    {
        $filter = in_array($request->input('filter'), ['waiting', 'published', 'all'], true) ? $request->input('filter') : 'waiting';
        $rating = in_array((int) $request->input('rating'), [1, 2, 3, 4, 5], true) ? (int) $request->input('rating') : null;
        $sort = in_array($request->input('sort'), ['newest', 'oldest', 'highest', 'lowest'], true) ? $request->input('sort') : 'newest';
        $search = trim((string) $request->input('search', ''));

        $counts = [
            'waiting'   => Review::where('status', 0)->count(),
            'published' => Review::where('status', 1)->count(),
        ];
        $counts['all'] = $counts['waiting'] + $counts['published'];

        $published = Review::where('status', 1);
        $average = round((float) (clone $published)->avg('rating'), 1);
        $breakdown = (clone $published)->selectRaw('rating, COUNT(*) as n')->groupBy('rating')->pluck('n', 'rating');

        $reviews = Review::with(['user', 'course.instructor'])
            ->when($filter === 'waiting', fn ($q) => $q->where('status', 0))
            ->when($filter === 'published', fn ($q) => $q->where('status', 1))
            ->when($rating, fn ($q) => $q->where('rating', $rating))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('review', 'like', "%{$search}%")
                        ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
                        ->orWhereHas('course', fn ($c) => $c->where('title', 'like', "%{$search}%"));
                });
            })
            ->when($sort === 'newest', fn ($q) => $q->latest('updated_at'))
            ->when($sort === 'oldest', fn ($q) => $q->oldest('updated_at'))
            ->when($sort === 'highest', fn ($q) => $q->orderByDesc('rating')->latest('updated_at'))
            ->when($sort === 'lowest', fn ($q) => $q->orderBy('rating')->latest('updated_at'))
            ->paginate(12)
            ->withQueryString();

        return view('admin.pages.review.index', [
            'pageTitle' => 'CAITD | Course Reviews',
            'reviews'   => $reviews,
            'counts'    => $counts,
            'average'   => $average,
            'breakdown' => $breakdown,
            'filter'    => $filter,
            'rating'    => $rating,
            'sort'      => $sort,
            'search'    => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $review->update(['status' => $request->status]);

        $who = optional($review->user)->name ?? 'This';
        $request->status == 1
            ? notyf()->success("{$who}'s review is now published on the course page.")
            : notyf()->success("{$who}'s review was unpublished and is hidden from the course page.");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        try {
            $review->delete();
            notyf()->success('Review deleted successfully.');
            return response([
                'message' => 'Deleted Successfully!'
            ], 200);

        } catch (\Exception $e) {
            logger($e);
            notyf()->error('Something went wrong while deleting the review.');
            return response([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
