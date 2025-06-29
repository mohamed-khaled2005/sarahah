<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPages;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [StaticPages::class,'index']) ->name('index');

//Global_pages
    Route::get('/blog',[StaticPages::class,'posts_index']);
    Route::get('/blog/single',[StaticPages::class,'posts_single']);
    Route::get('/blog/category',[StaticPages::class,'posts_category']);
    Route::get('single',[StaticPages::class,'pages']);
    Route::get('message',[StaticPages::class,'message_page']);

//login_pages
Route::middleware(['guest'])->group(
    function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login_user',[AuthController::class,'login_user'])->name('login_user');
    Route::get('/signup',[AuthController::class,'sign_up'])->name('register');
    Route::post('/save-user',[AuthController::class,'save_user'])->name('save-user');
    Route::get('/reset-password',[AuthController::class,'reset_password'])->name('reset_password');
    }
);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


// Users_Pages
Route::middleware(['auth'])->group(
    function(){
    Route::get('/user',[UserController::class,'user_index'])->name("user");
    Route::get('/user/inbox',[UserController::class,'user_inbox'])->name("user.index");
    Route::get('/user/profile',[UserController::class,'user_profile'])->name("user.profile");
    Route::get('/user/statistics',[UserController::class,'user_statistics'])->name("user.statistics");
    Route::get('/user/settings',[UserController::class,'user_settings'])->name("user.settings");
    }
);


// Admin_pages
Route::middleware(['admin'])->group(
    function(){
    Route::get('/admin',[AdminController::class,'admin_index'])->name('admin.index');
    Route::get('/admin/users',[AdminController::class,'admin_users'])->name('admin.users');
    Route::get('/admin/messages',[AdminController::class,'admin_messages'])->name('admin.messages');
    Route::get('/admin/posts',[AdminController::class,'admin_posts'])->name('admin.posts');
    Route::get('/admin/reports',[AdminController::class,'admin_reports'])->name('admin.reports');
    Route::get('/admin/ads',[AdminController::class,'admin_ads'])->name('admin.ads');
    Route::get('/admin/settings',[AdminController::class,'admin_settings'])->name('admin.settings');
    }
);



 

