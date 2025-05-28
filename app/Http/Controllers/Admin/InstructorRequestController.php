<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructorRequests = User::where('approval_status', 'pending')
            ->orWhere('approval_status', 'rejected')
            ->get();
        $data = [
            'pageTitle' => 'CAITD | Instructor Request'
        ];
        return view('admin.pages.instructor-requests.index', $data, compact('instructorRequests'));
    }

    /**
     * Download Instructor Document Or Resume.
     */
    public function downloadDoc(User $user)
    {
        return response()->download(public_path($user->document));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $instructor_request)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected']
        ]);

        $instructor_request->approval_status = $request->status;
        $request->status == 'approved' ? $instructor_request->role = 'instructor' : '';
        $instructor_request->save();

        if ($instructor_request->approval_status === 'approved') {
            if (config('mail_queue.is_queue')) {
                Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail($instructor_request));
            } else {
                Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail($instructor_request));
            }
        } elseif ($instructor_request->approval_status === 'rejected') {
            if (config('mail_queue.is_queue')) {
                Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail($instructor_request));
            } else {
                Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail($instructor_request));
            }
        }

        return redirect()->back();
    }


}
