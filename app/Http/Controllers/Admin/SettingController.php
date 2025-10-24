<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traites\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{

    use FileUpload;

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
            'site_phone' => 'nullable|string',
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
        // dd($request->all());
        $validatedData = $request->validate([
            'sender_email' => 'required|email|max:255',
            'receiver_email' => 'required|email|max:255',
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'nullable|string|max:10',
            'mail_queue' => 'required|in:true,false',
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

    public function logoFaviconSettings()
    {
        $data = [
            'pageTitle' => 'CAIDT | Logo & Favicon Settings',
        ];
        return view('admin.pages.site-settings.components.logo-favicon-settings', $data);
    }

    public function updateLogoFaviconSettings(Request $request)
    {
        $validatedData = $request->validate([
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'site_footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:1024',
            'site_breadcrumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('site_logo')) {
            $validatedData['site_logo'] = $this->uploadFile($request->file('site_logo'));
            if (config('settings.site_logo')) {
                $this->deleteIfImageExist(config('settings.site_logo'));
            }
        }
        if ($request->hasFile('site_footer_logo')) {
            $validatedData['site_footer_logo'] = $this->uploadFile($request->file('site_footer_logo'));
            if (config('settings.site_footer_logo')) {
                $this->deleteIfImageExist(config('settings.site_footer_logo'));
            }
        }
        if ($request->hasFile('site_favicon')) {
            $validatedData['site_favicon'] = $this->uploadFile($request->file('site_favicon'));
            if (config('settings.site_favicon')) {
                $this->deleteIfImageExist(config('settings.site_favicon'));
            }
        }
        if ($request->hasFile('site_breadcrumb')) {
            $validatedData['site_breadcrumb'] = $this->uploadFile($request->file('site_breadcrumb'));
            if (config('settings.site_breadcrumb')) {
                $this->deleteIfImageExist(config('settings.site_breadcrumb'));
            }
        }

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('settings');
        notyf()->success('Logo & Favicon settings updated successfully.');
        return redirect()->back();
    }

}
