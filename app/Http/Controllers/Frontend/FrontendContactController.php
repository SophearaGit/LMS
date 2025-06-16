<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendContactController extends Controller
{
    public function getContactUs()
    {
        $data = [
            'pageTitle' => 'CAITD | About Us',
            'contacts' => Contact::where('status', 1)->limit(4)->get(),
            'contactSetting' => ContactSetting::first(),
        ];
        return view('front.pages.contact-us', $data);
    }

    public function sendMail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if (config('mail_queue.is_queue')) {
            Mail::to(config('settings.receiver_email'))->queue(new ContactMail(
                $validatedData['name'],
                $validatedData['email'],
                $validatedData['subject'],
                $validatedData['message']
            ));
        } else {
            Mail::to(config('settings.receiver_email'))->send(new ContactMail(
                $validatedData['name'],
                $validatedData['email'],
                $validatedData['subject'],
                $validatedData['message']
            ));
        }

        notyf()->success('Your message has been sent successfully!');
        return redirect()->back();
    }

}
