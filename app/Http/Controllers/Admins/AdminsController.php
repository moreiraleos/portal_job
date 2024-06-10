<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin()
    {

        return view('admins.view-login');
    }

    public function checkLogin(Request $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $remember_me)) {
            return redirect()->route("admins.dashboard");
        }
        return redirect()->back()->with("error", "error login in");
    }

    public function index()
    {
        $jobs = Job::select()->count();
        $categories = Category::select()->count();
        $admins = Admin::select()->count();
        $applications = Application::select()->count();
        return view("admins.dashboard", compact('jobs', 'categories', 'admins', 'applications'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login'); // Redireciona para a página de login do admin
    }

    public function admins()
    {
        $admins = Admin::all();
        return view("admins.admins", compact("admins"));
    }

    public function create()
    {
        return view("admins.create");
    }

    public function storeAdmins(Request $request)
    {
        Request()->validate([
            "email" => "required",
            "username" => "required",
            "password" => "required"
        ]);

        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        $createAdmin =  Admin::create([
            'email' => $email,
            'name' => $username,
            'password' => Hash::make($password,)
        ]);
        if ($createAdmin) {
            return redirect("/admin/all-admins")->with("create", "Admin create successfully");
        }
    }

    public function categories()
    {
        $categories = Category::all();
        return view("admins.show-categories", compact('categories'));
    }

    public function createCategories()
    {
        return view("admins.create-categories");
    }

    public function storeCategory(Request $request)
    {

        Request()->validate([
            "name" => "required"
        ]);
        $category = Category::create([
            "name" => $request->get("name")
        ]);

        if ($category) {
            return redirect("/admin/all-categories")->with("create", "Create category successfully");
        } else {
            return redirect("/admin/all-categories")->with("error", "Error category successfully");
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();

        if ($category) {
            return redirect("/admin/all-categories")->with("delete", "Category delete successfully");
        }
    }

    public function updateCategory($id)
    {
        $category = Category::find($id);

        return view("admins.update-category", compact('category'));
    }

    public function editCategory(Request $request, $id)
    {

        Request()->validate([
            "name" => "required"
        ]);
        $category = Category::find($id);

        $category->update([
            "name" => $request->name
        ]);

        if ($category) {
            return redirect("/admin/all-categories")->with("update", "Category update successfully");
        }
    }

    public function showJobs()
    {
        $jobs = Job::all();
        return view("admins.show-jobs", compact('jobs'));
    }

    public function createJobs()
    {
        return view("admins.create-jobs");
    }

    public function storeJobs(Request $request)
    {

        Request()->validate([
            "job_title" => "required",
            "job_region" => "required",
            "company" => "required",
            "job_type" => "required",
            "vacancy" => "required",
            "experience" => "required",
            "salary" => "required",
            "gender" => "required",
            "application_deadline" => "required",
            "job_description" => "required",
            "responsibilities" => "required",
            "education_experience" => "required",
            "other_benefitis" => "required",
            "category" => "required",
            "image" => "required",
        ]);

        $destinationPath = "assets/images/";
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $createJobs = Job::create([
            "job_title" => $request->job_title,
            "job_region" => $request->job_region,
            "company_name" => $request->company,
            "job_type" => $request->job_type,
            "vacancy" => $request->vacancy,
            "experience" => $request->experience,
            "salary" => $request->salary,
            "gender" => $request->gender,
            "application_deadline" => $request->application_deadline,
            "job_description" => $request->job_description,
            "responsibilities" => $request->responsibilities,
            "education_experience" => $request->education_experience,
            "other_benefitis" => $request->other_benefitis,
            "category" => $request->category,
            "image" => $myimage,
        ]);

        if ($createJobs) {
            return redirect("admin/show-jobs")->with("create", "Created job successfully");
        }
    }


    public function deleteJobs($id)
    {
        $job = Job::find($id);
        if (is_file('assets/images/' . $job->image)) {
            unlink('assets/images/' . $job->image);
        }
        $job->delete();
        return redirect("admin/show-jobs")->with("delete", "Delete job successfully");
    }

    public function showApps()
    {
        $applications = Application::all();
        return view("admins.show-applications", compact("applications"));
    }

    public function deleteApps($id)
    {
        $application = Application::find($id);
        $application->delete();

        if ($application) {
            return redirect("/admin/show-apps")->with("delete", "Delete application successfully");
        }
    }
}
