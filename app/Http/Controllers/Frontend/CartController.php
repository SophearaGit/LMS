<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAITD | Cart',
            'cart' => Cart::with(['course'])
                ->where(['user_id' => Auth::guard('web')->user()?->id])
                ->paginate(),
        ];
        return view('front.pages.cart', $data);
    }
    public function store(Request $request, int $course_id)
    {
        if (!Auth::guard('web')->check()) {
            return response(
                [
                    'message' => 'Please Login First!',
                ],
                401
            );
        }

        if (Cart::where('user_id', Auth::guard('web')->user()->id)->where('course_id', $course_id)->exists()) {
            return response(
                [
                    'message' => 'Course already added to cart.',
                ],
                409
            );
        }

        $course = Course::findOrFail($course_id);
        $cart = new Cart();
        $cart->user_id = Auth::guard('web')->user()->id;
        $cart->course_id = $course->id;
        $cart->save();
        $data = [
            'pageTitle' => 'CAITD | Cart',
        ];
        return response(
            [
                'message' => 'Course added to cart successfully.',
            ],
            200
        );
    }

    public function destroy(int $cart_id)
    {
        $cart = Cart::where(['id' => $cart_id, 'user_id' => Auth::guard('web')->user()->id])->first();
        $cart->delete();
        notyf()->success('Course removed from cart successfully.');
        return redirect()->back();
    }

    public function checkout(int $cart_id)
    {
        $data = [
            'pageTitle' => 'CAITD | Checkout',
            'cart' => Cart::where(['id' => $cart_id, 'user_id' => Auth::guard('web')->user()->id])->first(),
        ];
        return view('front.pages.checkout', $data);

    }

}
