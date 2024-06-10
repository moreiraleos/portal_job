<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Job;

class CategoriesController extends Controller
{

    public function singleCategory($id)
    {
        $jobs = Job::where("category", $id)
            ->take(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $category = Category::find($id);

        return view('categories.single', compact('jobs', 'category'));
    }
}
