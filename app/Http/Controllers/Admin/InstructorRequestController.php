<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
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
            'pageTitle' => 'EduCore | Instructor Request'
        ];
        return view('admin.pages.index', $data, compact('instructorRequests'));
    }

    public function downloadDoc(User $user)
    {
        return response()->download(public_path($user->document));
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
    public function update(Request $request, User $instructor_request)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected']
        ]);

        $instructor_request->approval_status = $request->status;
        $request->status == 'approved' ? $instructor_request->role = 'instructor' : '';
        $instructor_request->save();

        if (config('mail_queue.is_queue')) {
            Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail($instructor_request));
        } else {
            Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail($instructor_request));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
