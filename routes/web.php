<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get("/", [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// about
Route::get("/about", [App\Http\Controllers\HomeController::class, 'about'])->name('about');
// contact
Route::get("/contact", [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// jobs
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/single/{id}', [App\Http\Controllers\Jobs\JobsController::class, 'single'])->name('single-job');
    Route::post('/save', [App\Http\Controllers\Jobs\JobsController::class, 'saveJob'])->name('save.job');
    Route::post('/apply', [App\Http\Controllers\Jobs\JobsController::class, 'jobApply'])->name('apply.job');
    Route::any('/search', [App\Http\Controllers\Jobs\JobsController::class, 'search'])->name('search.job');
});

// Categories
Route::group(['prefix' => 'categories'], function () {
    Route::get('/single/{id}', [App\Http\Controllers\Categories\CategoriesController::class, 'singleCategory'])->name('categories.single');
});

// Profile
Route::group(['prefix' => 'users'], function () {
    Route::get("/profile", [App\Http\Controllers\Users\UsersController::class, 'profile'])->name("profile");
    Route::get("/applications", [App\Http\Controllers\Users\UsersController::class, 'applications'])->name("applications");
    Route::get("/savedjobs", [App\Http\Controllers\Users\UsersController::class, 'savedJobs'])->name("saved.jobs");
    Route::get("/savedjobs", [App\Http\Controllers\Users\UsersController::class, 'savedJobs'])->name("saved.jobs");
    Route::get("/edit-details", [App\Http\Controllers\Users\UsersController::class, 'editDetails'])->name("edit.details");
    Route::post("/edit-details", [App\Http\Controllers\Users\UsersController::class, 'updateDetails'])->name("update.details");
    Route::get("/edit-cv", [App\Http\Controllers\Users\UsersController::class, 'editCV'])->name("edit.cv");
    Route::post("/edit-cv", [App\Http\Controllers\Users\UsersController::class, 'updateCV'])->name("update.cv");
});

Route::get("admin/login", [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name("view.login")->middleware('checkforauth');
Route::post("admin/login", [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name("check.login");

Route::group(['prefix' => 'admin', 'middleware' => "auth:admin"], function () {
    Route::get("/", [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name("admins.dashboard");
    Route::post('/logout', [App\Http\Controllers\Admins\AdminsController::class, 'logout'])->name('admin.logout');

    // admin
    Route::get("/all-admins", [App\Http\Controllers\Admins\AdminsController::class, 'admins'])->name("view.admins");
    Route::get("/create-admins", [App\Http\Controllers\Admins\AdminsController::class, 'create'])->name("create.admins");
    Route::post("/create-admins", [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name("store.admins");

    // categories
    Route::get("/all-categories", [App\Http\Controllers\Admins\AdminsController::class, 'categories'])->name("admins.categories");
    Route::get("/create-categories", [App\Http\Controllers\Admins\AdminsController::class, 'createCategories'])->name("create.categories");
    Route::post("/create-categories", [App\Http\Controllers\Admins\AdminsController::class, 'storeCategory'])->name("store.category");
    Route::get("/update-category/{id}", [App\Http\Controllers\Admins\AdminsController::class, 'updateCategory'])->name("update.category");
    Route::post("/update-category/{id}", [App\Http\Controllers\Admins\AdminsController::class, 'editCategory'])->name("edit.category");
    Route::get("/delete-category/{id}", [App\Http\Controllers\Admins\AdminsController::class, 'deleteCategory'])->name("delete.category");

    // jobs
    Route::get("/show-jobs", [App\Http\Controllers\Admins\AdminsController::class, 'showJobs'])->name("admin.jobs");
    Route::get("/create-jobs", [App\Http\Controllers\Admins\AdminsController::class, 'createJobs'])->name("create.jobs");
    Route::post("/create-jobs", [App\Http\Controllers\Admins\AdminsController::class, 'storeJobs'])->name("store.jobs");
    Route::get("/delete-jobs/{id}", [App\Http\Controllers\Admins\AdminsController::class, 'deleteJobs'])->name("delete.jobs");


    // applications
    Route::get("/show-apps", [App\Http\Controllers\Admins\AdminsController::class, 'showApps'])->name("admin.apps");
    Route::get("/delete-apps/{id}", [App\Http\Controllers\Admins\AdminsController::class, 'deleteApps'])->name("delete.apps");
});
