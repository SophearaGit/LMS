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
        // The three groups an instructor application can be in.
        $groups = [
            'pending'  => fn ($q) => $q->where('approval_status', 'pending'),
            'approved' => fn ($q) => $q->where('approval_status', 'approved')->where('role', 'instructor'),
            'rejected' => fn ($q) => $q->where('approval_status', 'rejected'),
        ];

        $counts = [];
        foreach ($groups as $key => $scope) {
            $counts[$key] = $scope(User::query())->count();
        }
        $counts['all'] = array_sum($counts);

        // Pending is what the admin needs to act on, so it is the default view.
        $status = $request->input('status', 'pending');
        if (! in_array($status, ['pending', 'approved', 'rejected', 'all'], true)) {
            $status = 'pending';
        }
        $search = trim((string) $request->input('search', ''));

        $query = User::query();
        if ($status === 'all') {
            $query->where(function ($q) use ($groups) {
                foreach ($groups as $scope) {
                    $q->orWhere(fn ($sub) => $scope($sub));
                }
            });
        } else {
            $groups[$status]($query);
        }

        $instructorRequests = $query
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            // Oldest pending first, so nobody waits at the bottom of the list.
            ->orderBy('created_at', $status === 'pending' ? 'asc' : 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('admin.pages.instructor-requests.index', [
            'pageTitle'          => 'Instructor Request - CAIT',
            'instructorRequests' => $instructorRequests,
            'counts'             => $counts,
            'status'             => $status,
            'search'             => $search,
        ]);
    }
    /**
     * Download Instructor Document Or Resume.
     */
    public function downloadDoc(User $user)
    {
        if (! $user->document || ! file_exists(public_path($user->document))) {
            notyf()->error('This document is no longer available.');
            return redirect()->back();
        }

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

        $mail = null;
        if ($instructor_request->approval_status === 'approved') {
            $mail = new InstructorRequestApprovedMail($instructor_request);
        } elseif ($instructor_request->approval_status === 'rejected') {
            if ($instructor_request->document) {
                $this->deleteIfImageExist($instructor_request->document);
                $instructor_request->document = null;
                $instructor_request->save();
            }
            $mail = new InstructorRequestRejectMail($instructor_request);
        }

        $mailSent = true;
        if ($mail) {
            try {
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue($mail);
                } else {
                    Mail::to($instructor_request->email)->send($mail);
                }
            } catch (\Throwable $e) {
                report($e);
                $mailSent = false;
            }
        }

        $name = $instructor_request->name;
        match ($instructor_request->approval_status) {
            'approved' => notyf()->success("{$name} is now an instructor."),
            'rejected' => notyf()->success("{$name}'s request was rejected."),
            default    => notyf()->success("{$name}'s request was moved back to pending."),
        };
        if (! $mailSent) {
            notyf()->error("The status was saved, but the email to {$name} could not be sent. Check SMTP settings.");
        }

        return redirect()->back();
    }
    public function toggleActive(Request $request, $id)
    {
        $instructor = User::where('role', 'instructor')->findOrFail($id);

        $request->validate(['account_status' => ['required', 'in:enabled,disabled']]);

        $instructor->account_status = $request->input('account_status');
        $instructor->save();

        notyf()->success($instructor->account_status === 'enabled'
            ? "{$instructor->name}'s account has been enabled."
            : "{$instructor->name}'s account has been disabled.");

        return back();
    }
}
