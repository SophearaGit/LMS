<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use App\Traites\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class InstructorRequestController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $instructorRequests = User::where('approval_status', 'pending')
    //         ->orWhere('approval_status', 'rejected')
    //         ->orWhere('approval_status', 'approved')
    //         // ✅ Sort By Status
    //         ->when($request->has('status') && $request->filled('status'), function ($query) use ($request) {
    //             $query->where('approval_status', $request->status);
    //         })
    //         ->latest()
    //         ->get();
    //     $data = [
    //         'pageTitle' => 'CAITD | Instructor Request'
    //     ];
    //     return view('admin.pages.instructor-requests.index', $data, compact('instructorRequests'));
    // }
    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Instructor Request - CAIT',
            'instructorRequests' => User::whereIn('approval_status', [
                'pending',
                // 'approved',
                'rejected'
            ])
                ->when($request->filled('status'), function ($query) use ($request) {
                    $query->where('approval_status', $request->status);
                })
                ->latest()
                ->get(),
        ];
        return view('admin.pages.instructor-requests.index', $data);
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
            if ($instructor_request->document) {
                $this->deleteIfImageExist($instructor_request->document);
                $instructor_request->document = null;
                $instructor_request->save();
            }
            if (config('mail_queue.is_queue')) {
                Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail($instructor_request));
            } else {
                Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail($instructor_request));
            }
        }
        return redirect()->back();
    }
    public function toggleActive(Request $request, $id)
    {
        $instructor = User::where('role', 'instructor')->findOrFail($id);

        $instructor->account_status = $request->input('account_status'); // 'enabled' or 'disabled'
        $instructor->save();

        $message = $instructor->account_status === 'enabled'
            ? "{$instructor->name}'s account has been enabled."
            : "{$instructor->name}'s account has been disabled.";

        return back()->with('success', $message);
    }
}
