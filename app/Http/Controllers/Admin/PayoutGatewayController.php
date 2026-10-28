<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstructorPayoutInformation;
use App\Models\PayoutGateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * Payout gateways are the ways instructors can be paid (bank, ABA, PayPal…).
 * Instructors pick one by NAME in their payout settings, and the description is
 * shown to them as instructions for what details to enter.
 */
class PayoutGatewayController extends Controller
{
    public function index(Request $request)
    {
        $gateways = PayoutGateway::orderByDesc('status')->orderBy('name')->get();

        // How many instructors currently have each gateway selected (matched by name).
        $usage = InstructorPayoutInformation::select('gateway', DB::raw('COUNT(*) as total'))
            ->groupBy('gateway')->pluck('total', 'gateway');

        return view('admin.pages.payout-settings.index', [
            'pageTitle'      => 'CAITD | Payout Gateways',
            'payoutGateways' => $gateways,
            'usage'          => $usage,
            'activeCount'    => $gateways->where('status', '1')->count(),
            'instructorsSet' => $usage->sum(),
            // ?add or ?edit={id} opens the matching dialog (also used by the old create/edit URLs).
            'openAdd'        => $request->has('add'),
            'openEdit'       => (int) $request->input('edit'),
        ]);
    }

    public function create()
    {
        return redirect()->route('admin.payout-gateways.index', ['add' => 1]);
    }

    public function edit(PayoutGateway $payoutGateway)
    {
        return redirect()->route('admin.payout-gateways.index', ['edit' => $payoutGateway->id]);
    }

    public function show()
    {
        return redirect()->route('admin.payout-gateways.index');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $gateway = new PayoutGateway();
        $gateway->name = $data['name'];
        $gateway->description = $data['description'];
        $gateway->status = $data['status'];
        $gateway->save();

        notyf()->success("{$gateway->name} was added.");

        return redirect()->route('admin.payout-gateways.index');
    }

    public function update(Request $request, PayoutGateway $payoutGateway)
    {
        $data = $this->validated($request, $payoutGateway);
        $oldName = $payoutGateway->name;

        DB::transaction(function () use ($payoutGateway, $data, $oldName) {
            $payoutGateway->name = $data['name'];
            $payoutGateway->description = $data['description'];
            $payoutGateway->status = $data['status'];
            $payoutGateway->save();

            // Instructors reference the gateway by name: keep them linked after a rename.
            if ($oldName !== $data['name']) {
                InstructorPayoutInformation::where('gateway', $oldName)->update(['gateway' => $data['name']]);
            }
        });

        notyf()->success("{$payoutGateway->name} was updated.");

        return redirect()->route('admin.payout-gateways.index');
    }

    public function toggle(PayoutGateway $payoutGateway)
    {
        $payoutGateway->status = $payoutGateway->status == 1 ? 0 : 1;
        $payoutGateway->save();

        $payoutGateway->status == 1
            ? notyf()->success("{$payoutGateway->name} is now available to instructors.")
            : notyf()->success("{$payoutGateway->name} is hidden from instructors.");

        return redirect()->route('admin.payout-gateways.index');
    }

    public function destroy(PayoutGateway $payoutGateway)
    {
        try {
            $name = $payoutGateway->name;
            $payoutGateway->delete();
            notyf()->success("{$name} was deleted.");

            return response()->json(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger($e);

            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    private function validated(Request $request, ?PayoutGateway $current = null): array
    {
        // Lets the form reopen the right dialog if validation fails.
        $request->session()->flash('gateway_form', $current ? 'edit-' . $current->id : 'add');

        return $request->validate([
            'name'        => ['required', 'string', 'max:255', Rule::unique('payout_gateways', 'name')->ignore($current?->id)],
            'description' => ['required', 'string', 'max:2000'],
            'status'      => ['required', 'boolean'],
        ], [
            'name.unique' => 'A gateway with this name already exists.',
            'description.required' => 'Tell instructors what details to enter for this gateway.',
        ]);
    }
}
