<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPages;

Route::get('/', [StaticPages::class,'index']);

//login_pages
Route::get('/login',[StaticPages::class,'login']);
Route::get('/signup',[StaticPages::class,'sign_up']);
Route::get('/reset-password',[StaticPages::class,'reset_password']);

//Global_pages
Route::get('/blog',[StaticPages::class,'posts_index']);
Route::get('/blog/single',[StaticPages::class,'posts_single']);
Route::get('/blog/category',[StaticPages::class,'posts_category']);
Route::get('single',[StaticPages::class,'pages']);
Route::get('message',[StaticPages::class,'message_page']);
// Users_pages
Route::get('/users',[StaticPages::class,'user_index']);
Route::get('/users/inbox',[StaticPages::class,'user_inbox']);
Route::get('/users/profile',[StaticPages::class,'user_profile']);
Route::get('/users/statistics',[StaticPages::class,'user_statistics']);
Route::get('/users/settings',[StaticPages::class,'user_settings']);


// Admin_pages
Route::get('/admin',[StaticPages::class,'admin_index']);
Route::get('/admin/users',[StaticPages::class,'admin_users']);
Route::get('/admin/messages',[StaticPages::class,'admin_messages']);
Route::get('/admin/posts',[StaticPages::class,'admin_posts']);
Route::get('/admin/reports',[StaticPages::class,'admin_reports']);
Route::get('/admin/ads',[StaticPages::class,'admin_ads']);
Route::get('/admin/settings',[StaticPages::class,'admin_settings']);


