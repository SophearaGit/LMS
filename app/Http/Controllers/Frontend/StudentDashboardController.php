<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use App\Traites\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    use FileUpload;

    public function index()
    {
        $date = [
            'pageTitle' => 'CAITD | Student-Dashboard',
            'enrolledCoursesCount' => Auth::user()->enrollments->count(),
            'reviewsCount' => Review::where('user_id', Auth::id())->count(),
            'ordersCount' => Order::where('buyer_id', Auth::id())->count(),
            'orders' => Order::where('buyer_id', Auth::id())->take(10)->get(),
        ];
        // dd($date);
        return view('front.pages.student.index', $date);
    }

    /**
     * STUDENT ATTEMPT TO BECOME INSTRUCTOR (Template View).
     */
    public function becomeInstructor(Request $request)
    {
        // if (auth()->user()->role === 'instructor') ah nih default ber meet error use ah nih vinh.
        //     abort(403);
        if (auth()->guard()->user()->role === 'instructor')
            abort(403);

        $data = [
            'pageTitle' => 'CAITD | Become Instructor'
        ];

        return view('front.pages.student.become-instructor', $data);

    }
    /**
     * STUDENT ATTEMPT TO BECOME INSTRUCTOR (UPDATE).
     */
    public function becomeInstructorUpdate(Request $request, User $user)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12000'],
        ]);
        $filePath = $this->uploadFile($request->file('document'));
        $user->update([
            'approval_status' => 'pending',
            'document' => $filePath,
        ]);
        return redirect()->route('student.dashboard');
    }

    public function getReview()
    {
        $data = [
            'pageTitle' => 'CAITD | Review',
            'reviews' => Review::where('user_id', Auth::id())
                ->with(['course'])
                ->latest()
                ->paginate(10)
        ];
        return view('front.pages.student.reviews.index', data: $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteReview(Review $review)
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

