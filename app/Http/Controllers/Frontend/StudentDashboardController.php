<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traites\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUpload;

    public function index()
    {
        $date = [
            'pageTitle' => 'EdoCore | Student-Dashboard'
        ];
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
            'pageTitle' => 'EduCore | Become Instructor'
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
}

