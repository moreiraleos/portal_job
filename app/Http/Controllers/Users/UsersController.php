<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Job\Application;
use App\Models\Job\JobSaved;
use App\Models\User;
use App\Models\Users\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class UsersController extends Controller
{
    public function profile()
    {
        $profile  = User::find(Auth::user()->id);
        return view('users.profile', compact('profile'));
    }

    public function applications()
    {
        $applications = Application::where("user_id", Auth::user()->id)->get();
        return view('users.applications', compact('applications'));
    }
    public function savedJobs()
    {
        $savedJobs = JobSaved::where("user_id", Auth::user()->id)->get();
        return view('users.savedjobs', compact('savedJobs'));
    }

    public function editDetails()
    {
        $userDetails = User::find(Auth::user()->id);
        return view('users.editdetails', compact('userDetails'));
    }

    public function updateDetails(Request $request)
    {
        $userDetailsUpdate = User::find(Auth::user()->id);
        if (!$userDetailsUpdate) {
            return redirect(url("/home"));
        }

        Request()->validate([
            "name" => "required|max:40",
            "job_title" => "required|max:40",
            "bio" => "required",
            "facebook" => "required|max:140",
            "twitter" => "required|max:140",
            "linkedin" => "required|max:140"
        ]);

        $userDetailsUpdate->update([
            "name" => $request->name,
            "job_title" => $request->job_title,
            "bio" => $request->bio,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "linkedin" => $request->linkedin,
        ]);
        
        if ($userDetailsUpdate) {
            return redirect("/users/edit-details/")->with('update', 'User details update successfully');
        } else {
            return redirect("/users/edit-details/")->with('error', 'Error update');
        }
        
    }

    public function editCV()
    {
        return view('/users.editcv');
    }

    public function updateCV(Request $request)
    {
        $userUpdate = User::find(Auth::user()->id);
        if (!$userUpdate || !$request->cv) {
            return redirect(url("/home"));
        }

        if (is_file('assets/cvs/' . $userUpdate->cv)) {
            // $file_path = public_path('assets/cvs/' . $userUpdate->cv);
            // var_dump($file_path);
            // exit;
            unlink('assets/cvs/' . $userUpdate->cv);
            // File::delete('assets/cvs/' . $userUpdate->cv);
        }

        $destinationPath = 'assets/cvs/';
        $myFile = $request->cv->getClientOriginalName();
        $request->cv->move(public_path($destinationPath), $myFile);

        $userUpdate->Update([
            "cv" => $myFile
        ]);

        // $userUpdateCV = User::update([
        //     "cv" => $myFile
        // ]);

        if ($userUpdate) {
            return redirect("/users/edit-cv")->with('update', 'CV updated successfully');
        } else {
            return redirect("/users/edit-cv")->with('error', 'Error update CV');
        }
    }
}
