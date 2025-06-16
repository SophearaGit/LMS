<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{

    public function commissionSettings()
    {
        $data = [
            'pageTitle' => 'CAIDT | Commission Settings',
        ];
        return view('admin.pages.site-settings.components.commission-settings', $data);
    }

    public function updateCommissionSettings(Request $request)
    {
        $validated_data = $request->validate([
            'commission' => 'required|numeric',
        ]);

        foreach ($validated_data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');

        return redirect()->back();

    }


    public function index()
    {
        $data = [
            'pageTitle' => 'CAIDT | General Settings',
        ];
        return view('admin.pages.site-settings.components.general-settings', $data);
    }

    public function updateGeneralSettings(Request $request)
    {
        $validated_data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_phone' => 'nullable|numeric',
            'site_address' => 'nullable|string|max:255',
            'site_currency' => 'required|string|max:3',
            'site_currency_icon' => 'required|string|max:255',
        ]);

        foreach ($validated_data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');

        return redirect()->back();
    }

    public function smtpSettings()
    {
        $data = [
            'pageTitle' => 'CAIDT | SMTP Settings',
        ];
        return view('admin.pages.site-settings.components.smtp-settings', $data);
    }

    public function updateSmtpSettings(Request $request)
    {
        $validatedData = $request->validate([
            'sender_email' => 'required|email|max:255',
            'receiver_email' => 'required|email|max:255',
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');

        notyf()->success('Settings updated successfully.');
        return redirect()->back();
    }

}
