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
     * INSTRUCTOR PROFILE (Template View).
     */
    public function instructorProfile(Request $request)
    {
        $data = [
            'pageTitle' => 'EduCore | Instructor Profile'
        ];
        return view('front.pages.instructor.profile', $data);
    }
    /**
     * STUDENT PROFILE (Template View).
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatar = $this->uploadFile($request->file('avatar'));
            $this->deleteIfImageExist($user->image);
            $user->image = $avatar;
        }
        $user->name = $request->name;
        $user->headline = $request->headline;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->save();
        notyf()->success('Profile updated successfully');
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
        notyf()->success('Password updated successfully');
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
        notyf()->success('Social link updated successfully');
        return redirect()->back();
    }
}
