<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use App\Models\Job\JobSaved;
use App\Models\Job\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function single($id)
    {
        $job = Job::find($id);
        // getting related jobs
        $relatedJobs = Job::where("category", $job->category)->where("id", "!=", $id)->take(5)->get();
        $totalRelatedJobs = $relatedJobs->count();
        if (!$job) {
            return redirect()->back();
        }

        if (Auth::user()) {
            // save job
            $savedJob = JobSaved::where('job_id', $id)->where('user_id', Auth::user()->id)->count();
            // verifing if user applied to job
            $appliedJob = Application::where("user_id", Auth::user()->id)
                ->where("job_id", $id)
                ->count();
            // categories
            // $categories = Category::all();

            $categories = DB::table("categories")
                ->join("jobs", "jobs.category", "=", "categories.id")
                ->select("categories.name AS name", "categories.id AS id", DB::raw("COUNT(jobs.category) AS total"))
                ->groupBy("jobs.category")
                ->get();

            

            return view('jobs.single', compact('job', 'relatedJobs', 'totalRelatedJobs', 'savedJob', 'appliedJob', 'categories'));
        } else {
            return view('jobs.single', compact('job', 'relatedJobs', 'totalRelatedJobs'));
        }
    }

    public function saveJob(Request $request)
    {
        $saveJob = JobSaved::create([
            'job_id' => $request->job_id,
            'user_id' => $request->user_id,
            'job_image' => $request->job_image,
            'job_title' => $request->job_title,
            'job_region' => $request->job_id,
            'job_type' => $request->job_type,
            'company' => $request->job_company,
        ]);

        if ($saveJob) {
            return redirect("/jobs/single/" . $request->job_id)->with("save", "Job saved successfully");
        }
    }

    public function jobApply(Request $request)
    {
        if (Auth::user()->cv == "No cv") {
            return redirect("/jobs/single/" . $request->job_id)->with("apply", "Upload you CV first in the profile page");
        } else {
            $applyJob = Application::create([
                'user_id' => $request->user_id,
                'company_image' => $request->job_image,
                'location' => $request->job_region,
                'job_type' => $request->job_type,
                'email' => $request->email,
                'job_id' => $request->job_id,
                'company_name' => $request->company,
                'cv' => Auth::user()->cv,
                'job_title' => $request->job_title
            ]);
            if ($applyJob) {
                return redirect("/jobs/single/" . $request->job_id)->with("applied", "you applied to this job successfully");
            }
        }
    }

    public function search(Request $request)
    {
        Request()->validate([
            "job_region" => "required",
            "job_title" => "required",
            "job_type" => "required"
        ]);

        Search::create([
            "keyword" => $request->job_title,
        ]);

        $job_title = $request->get('job_title');
        $job_region = $request->get('job_region');
        $job_type = $request->get('job_type');


        $searches = Job::select()
            ->where('job_title', 'like', '%' . $job_title . '%')
            ->where('job_region', 'like', '%' . $job_region . '%')
            ->where('job_type', 'like', '%' . $job_type . '%')
            ->get();

        return view('jobs.search', compact('searches'));
    }
}
