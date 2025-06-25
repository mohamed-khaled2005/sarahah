<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPages;

Route::get('/', [StaticPages::class,'index']);
//login_pages
Route::get('/login',[StaticPages::class,'login']);
Route::get('/signup',[StaticPages::class,'sign_up']);
Route::get('/reset-password',[StaticPages::class,'reset_password']);
// dynamic_pages
Route::get('/blog',[StaticPages::class,'blog']);


