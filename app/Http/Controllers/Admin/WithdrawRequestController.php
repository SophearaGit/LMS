<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Withdraw Request',
            'withdrawRequests' => Withdraw::with('instructor')->latest()->paginate(15),
        ];
        return view('admin.pages.withdraw-requests.index', $data);
    }

    public function show(Withdraw $withdraw)
    {
        $data = [
            'pageTitle' => 'CAIDT | Withdraw Request',
            'withdraw' => $withdraw->load('instructor'),
            'instructorPayoutInformation' => $withdraw->instructor->payoutInformation,
        ];
        return view('admin.pages.withdraw-requests.show', $data);
    }

    // updateStatus model binding
    public function updateStatus(Withdraw $withdraw, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($request->status == 'approved' && $withdraw->status != 'pending') {
            notyf()->error('Withdraw request already processed.');
            return redirect()->route('admin.withdraw-request.index');
        }

        $withdraw->status = $request->status;
        if ($request->status == 'approved') {
            $withdraw->instructor->wallet = ($withdraw->instructor->wallet - $withdraw->amount);
            $withdraw->instructor->save();
        }
        $withdraw->save();

        notyf()->success('Withdraw request status updated successfully.');

        return redirect()->route('admin.withdraw-request.index');
    }


}
