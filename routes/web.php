<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPages;
use App\Http\Controllers\AuthController;

Route::get('/', [StaticPages::class,'index']) ->name('index');

//login_pages
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/signup',[AuthController::class,'sign_up'])->name('register');
Route::post('/save-user',[AuthController::class,'save_user'])->name('save-user');
Route::get('/reset-password',[AuthController::class,'reset_password'])->name('reset_password');

//Global_pages
Route::get('/blog',[StaticPages::class,'posts_index']);
Route::get('/blog/single',[StaticPages::class,'posts_single']);
Route::get('/blog/category',[StaticPages::class,'posts_category']);
Route::get('single',[StaticPages::class,'pages']);
Route::get('message',[StaticPages::class,'message_page']);
// Users_pages
Route::get('/user',[StaticPages::class,'user_index']);
Route::get('/user/inbox',[StaticPages::class,'user_inbox']);
Route::get('/user/profile',[StaticPages::class,'user_profile']);
Route::get('/user/statistics',[StaticPages::class,'user_statistics']);
Route::get('/user/settings',[StaticPages::class,'user_settings']);


// Admin_pages
Route::get('/admin',[StaticPages::class,'admin_index']);
Route::get('/admin/users',[StaticPages::class,'admin_users']);
Route::get('/admin/messages',[StaticPages::class,'admin_messages']);
Route::get('/admin/posts',[StaticPages::class,'admin_posts']);
Route::get('/admin/reports',[StaticPages::class,'admin_reports']);
Route::get('/admin/ads',[StaticPages::class,'admin_ads']);
Route::get('/admin/settings',[StaticPages::class,'admin_settings']);


