<?php
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsCategoryController;
use App\Http\Controllers\admin\NewsController;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UiController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function(){
    //LogIn
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginform'])->name('login');
    //Register
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerform'])->name('register');
    // Route::post('register/{id}/update', [AuthController::class, 'registerUpdate'])->name("registerUpdate");
});
Route::post('register/{id}/update', [AuthController::class, 'registerUpdate'])->name("registerUpdate");
//Ui_Panel
Route::get('/', [UiController::class, 'index'])->name('index');
//Search Category
Route::get('search', [UiController::class, 'search'])->name('search');
Route::get('search_category/{id}', [UiController::class, 'search_category'])->name('search_category');
//News
Route::get('/news', [UiController::class, 'news'])->name('news');
//New Detail
Route::get('/news/{id}/detail', [UiController::class, 'news_detail'])->name('news_detail');
//New Search
Route::get('searchNews', [UiController::class, 'searchNews'])->name('searchNews');
Route::get('news/{id}/search', [UiController::class, 'search_news'])->name('search_news');
//News Comment
Route::post('news/comment/{id}', [CommentController::class, 'comment'])->name('newsComment');



Route::middleware('auth')->group(function () {
    //Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   //Employee Profile
    Route::get('employee-profile', [UiController::class, 'profile'])->name('profile');
    //Application
    Route::get('application/{id}', [ApplicationController::class, 'apply'])->name('apply');
    Route::post('application/store', [ApplicationController::class, 'store'])->name('applicationForm');
});

//Admin_panel
Route::prefix('admin')->middleware('auth', 'IsEmployer')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('payment', [DashboardController::class, 'payment'])->name('payment');
    Route::post('payment/create', [DashboardController::class, 'paymentStore'])->name('paymentStore');
    Route::get('user', [DashboardController::class, 'userList'])->name('userList');
    Route::get('payment/{employerId}/detail', [DashboardController::class, 'paymentDetail'])->name('paymentDetail');
    Route::post('payment/{userId}/confirm', [DashboardController::class, 'paymentConfirm'])->name('paymentConfirm');
    Route::get('report', [DashboardController::class, 'report'])->name('report');


    Route::resource('categories', CategoryController::class);
    Route::resource('jobs', JobController::class);
    //NewsCategory
    Route::resource('newsCategories', NewsCategoryController::class);
    //News
    Route::resource('news', NewsController::class);
    Route::post('comment/{id}/show_hide', [NewsController::class, 'showHideComment']);
    //CV
    Route::get('job/{id}/cv', [JobController::class, 'cv']);

    Route::post('application/{id}/accept', [JobController::class, 'acceptApplication'])->name('applications.accept');
    Route::post('application/{id}/reject', [JobController::class, 'rejectApplication'])->name('applications.reject');
});