<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traites\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateController extends Controller
{
    use FileUpload;

    public function profile()
    {
        $data = [
            'pageTitle' => 'CAITD | Profile',
            'personalDetails' => Auth::user(),
        ];
        return view('admin.pages.profile.index', $data);
    }
    public function update(Request $request)
    {

        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:51200',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            if ($request->old_image) {
                $this->deleteIfImageExist($request->old_image);
            }
            $validatedData['image'] = $imagePath;
        }

        Auth::guard('admin')->user()->update(
            [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'bio' => $validatedData['bio'],
                'image' => $validatedData['image'] ?? Auth::guard('admin')->user()->image,
            ]
        );

        notyf()->success('Profile updated successfully.');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate(
            [
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        Auth::guard('admin')->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        notyf()->success('Password updated successfully.');
        return redirect()->back();
    }

}
