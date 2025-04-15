<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileUpdatePasswordRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateSocialLink;
use Illuminate\Http\Request;
use App\Traites\FileUpload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;
    /**
     * STUDENT PROFILE (Template View).
     */
    public function profile(Request $request)
    {
        $data = [
            'pageTitle' => 'EduCore | Student Profile'
        ];
        return view('front.pages.student.profile', $data);
    }
    /**
     * STUDENT PROFILE (Template View).
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->headline = $request->headline;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->save();
        return redirect()->back();
    }
    /**
     * STUDENT UPDATE PASSWORD
     */
    public function updatePasswordProfileStore(ProfileUpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back();
    }
    /**
     * STUDENT UPDATE SOCIAL LINK
     */
    public function updateSocialLink(ProfileUpdateSocialLink $request)
    {
        $user = Auth::user();
        $user->facebook = $request->facebook;
        $user->x = $request->x;
        $user->linkedin = $request->linkedin;
        $user->website = $request->website;
        $user->github = $request->github;
        $user->save();
        return redirect()->back();
    }
}
