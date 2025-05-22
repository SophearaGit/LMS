<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutGateway;
use Exception;
use Illuminate\Http\Request;

class PayoutGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | Payout Gateway',
            'payoutGateways' => PayoutGateway::paginate(15),
        ];
        return view('admin.pages.payout-settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'CAIDT | Create Payout Gateway',
        ];
        return view('admin.pages.payout-settings.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'status' => 'required|boolean',
        ]);

        $payoutGateway = new PayoutGateway();
        $payoutGateway->name = $request->name;
        $payoutGateway->description = $request->description;
        $payoutGateway->status = $request->status;
        $payoutGateway->save();
        notyf()->success('Payout Gateway created successfully.');

        return redirect()->route('admin.payout-gateways.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayoutGateway $payoutGateway)
    {
        $data = [
            'pageTitle' => 'CAIDT | Payout Gateway Details',
            'payoutGateway' => $payoutGateway,
        ];
        return view('admin.pages.payout-settings.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayoutGateway $payoutGateway)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'status' => 'required|boolean',
        ]);

        $payoutGateway->name = $request->name;
        $payoutGateway->description = $request->description;
        $payoutGateway->status = $request->status;
        $payoutGateway->save();
        notyf()->success('Payout Gateway updated successfully.');

        return redirect()->route('admin.payout-gateways.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayoutGateway $payoutGateway)
    {
        try {
            $payoutGateway->delete();
            notyf()->success('Deleted Successfully!');
            return response()->json([
                'message' => 'Deleted Successfully!',
            ], 200);
        } catch (Exception $e) {
            logger($e);
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
