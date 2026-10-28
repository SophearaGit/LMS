<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Instructor payout (withdraw) requests.
 * Approving = the admin has sent the money; it is deducted from the instructor's wallet.
 * A request can only be decided once, while it is pending.
 */
class WithdrawRequestController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');
        if (! in_array($status, ['pending', 'approved', 'rejected', 'all'], true)) {
            $status = 'pending';
        }
        $search = trim((string) $request->input('search', ''));

        $counts = Withdraw::select('status', DB::raw('COUNT(*) as n'))->groupBy('status')->pluck('n', 'status');
        $counts = [
            'pending'  => (int) ($counts['pending'] ?? 0),
            'approved' => (int) ($counts['approved'] ?? 0),
            'rejected' => (int) ($counts['rejected'] ?? 0),
        ];
        $counts['all'] = array_sum($counts);

        $totals = [
            'pending'   => (float) Withdraw::where('status', 'pending')->sum('amount'),
            'paid'      => (float) Withdraw::where('status', 'approved')->sum('amount'),
            'paidMonth' => (float) Withdraw::where('status', 'approved')->where('updated_at', '>=', now()->startOfMonth())->sum('amount'),
        ];

        $withdrawRequests = Withdraw::with(['instructor.payoutInformation'])
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('transaction_id', 'like', "%{$search}%")
                        ->orWhereHas('instructor', fn ($i) => $i->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%"));
                });
            })
            // Oldest pending first: nobody waits at the bottom of the list.
            ->orderBy('created_at', $status === 'pending' ? 'asc' : 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.withdraw-requests.index', [
            'pageTitle'        => 'CAITD | Payout Requests',
            'withdrawRequests' => $withdrawRequests,
            'counts'           => $counts,
            'totals'           => $totals,
            'status'           => $status,
            'search'           => $search,
        ]);
    }

    public function show(Withdraw $withdraw)
    {
        $withdraw->load('instructor.payoutInformation');

        $history = Withdraw::where('instructor_id', $withdraw->instructor_id)
            ->whereKeyNot($withdraw->id)->latest()->take(5)->get();

        return view('admin.pages.withdraw-requests.show', [
            'pageTitle'                   => 'CAITD | Payout Request',
            'withdraw'                    => $withdraw,
            'instructorPayoutInformation' => optional($withdraw->instructor)->payoutInformation,
            'history'                     => $history,
            'paidTotal'                   => (float) Withdraw::where('instructor_id', $withdraw->instructor_id)->where('status', 'approved')->sum('amount'),
        ]);
    }

    public function updateStatus(Withdraw $withdraw, Request $request)
    {
        $request->validate([
            'status'         => 'required|in:approved,rejected',
            'transaction_id' => 'nullable|string|max:255',
        ], [
            'status.in' => 'Choose to mark the request as paid or reject it.',
        ]);

        if ($withdraw->status !== 'pending') {
            notyf()->error('This request was already ' . ($withdraw->status === 'approved' ? 'paid' : 'rejected') . ' and can’t be changed.');
            return redirect()->route('admin.withdraw-request.show', $withdraw->id);
        }

        $instructor = $withdraw->instructor;

        if ($request->status === 'approved' && $instructor && round((float) $instructor->wallet, 2) < round((float) $withdraw->amount, 2)) {
            notyf()->error('The instructor’s wallet balance is lower than this payout, so it can’t be marked as paid.');
            return redirect()->route('admin.withdraw-request.show', $withdraw->id);
        }

        DB::transaction(function () use ($withdraw, $instructor, $request) {
            $withdraw->status = $request->status;
            if ($request->status === 'approved') {
                $withdraw->transaction_id = $request->filled('transaction_id') ? trim($request->transaction_id) : null;
                if ($instructor) {
                    $instructor->wallet = round((float) $instructor->wallet - (float) $withdraw->amount, 2);
                    $instructor->save();
                }
            }
            $withdraw->save();
        });

        $name = optional($instructor)->name ?? 'The instructor';
        $amount = config('settings.site_currency_icon') . number_format((float) $withdraw->amount, 2);
        $request->status === 'approved'
            ? notyf()->success("Marked {$amount} to {$name} as paid.")
            : notyf()->success("{$name}’s payout request was rejected. Their balance is unchanged.");

        return redirect()->route('admin.withdraw-request.index');
    }
}
