<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Course Reviews',
            'reviews' => Review::with(['user', 'course'])->latest()->paginate(10),
        ];
        return view('admin.pages.review.index', $data);
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

        notyf()->success('Review status updated successfully.');
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
