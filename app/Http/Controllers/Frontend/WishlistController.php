<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $wishlisted = false;
            $message = 'Removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'course_id' => $request->course_id,
            ]);
            $wishlisted = true;
            $message = 'Added to wishlist!';
        }

        return response()->json([
            'success' => true,
            'wishlisted' => $wishlisted,
            'message' => $message,
        ]);
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | My Wishlist',
            'wishlists' => Wishlist::with('course')
                ->where('user_id', Auth::id())
                ->latest()
                ->get(),
        ];

        return view('front.pages.wishlist', $data);
    }

    public function modalItems()
    {
        $wishlists = Wishlist::with('course')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('front.partials.wishlist-modal-items', compact('wishlists'));
    }

}
