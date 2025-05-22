<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WithdrawController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Withdraw',
        ];
        return view('front.pages.instructor.withdraw.index', $data);
    }

    // requestPayout
    public function requestPayout(Request $request)
    {
        $data = [
            'pageTitle' => 'CAIDT | Withdraw',
            'currentBallance' => Auth::user()->wallet,
            'pendingBallance' => Withdraw::where('instructor_id', Auth::user()->id)->where('status', 'pending')->sum('amount'),
            'totalPayout' => Withdraw::where('instructor_id', Auth::user()->id)->where('status', 'approved')->sum('amount'),
        ];
        return view('front.pages.instructor.withdraw.request-payout', $data);
    }
    public function requestPayoutStore(Request $request)
    {
        try {
            $request->validate([
                'payout_amount' => 'required|numeric|min:1|max:' . Auth::user()->wallet,
            ]);
            if(Withdraw::where('instructor_id', Auth::user()->id)->where('status', 'pending')->exists()){
                notyf()->addError('You have already requested a payout. Please wait for it to be approved.');
                return redirect()->back();
            }
            $withdraw = new Withdraw();
            $withdraw->instructor_id = Auth::user()->id;
            $withdraw->amount = $request->payout_amount;
            $withdraw->status = 'pending';
            $withdraw->save();
            notyf()->addSuccess('Payout request submitted successfully. Please wait for it to be approved.');
            return redirect()->route('instructor.withdraws.request_payout');
        } catch (ValidationException $e) {
            notyf()->addError($e->validator->errors()->first());
            return redirect()->back();
        }
    }


}
