<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPages;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;


Route::post('/notifications/mark-read',
    [NotificationController::class, 'markRead']
)->name('notifications.markRead')->middleware('auth');



Route::get('/', [StaticPages::class,'index']) ->name('index');
//Global_pages
    Route::get('/blog',[StaticPages::class,'posts_index']);
    Route::get('/blog/single',[StaticPages::class,'posts_single']);
    Route::get('/blog/category',[StaticPages::class,'posts_category']);
    Route::get('single',[StaticPages::class,'pages']);

//login_pages
Route::middleware(['guest'])->group(
    function(){
    Route::get('/login',[AuthController::class,'login'])->name('login')->middleware('throttle:5,1');;
    Route::post('/login_user',[AuthController::class,'login_user'])->name('login_user');
    Route::get('/signup',[AuthController::class,'sign_up'])->name('register');
    Route::post('/save-user',[AuthController::class,'save_user'])->name('save-user');
    Route::get('/reset-password',[AuthController::class,'reset_password'])->name('reset_password');
    }
);

Route::post('/logout',[AuthController::class,'logout'])->name('logout');


// Users_Pages
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get ('/',           [UserController::class,'user_index'])->name('user');
    Route::get ('/inbox',      [UserController::class,'user_inbox'])->name('user.index');
    Route::get ('/profile',    [UserController::class,'user_profile'])->name('user.profile');
    Route::post('/profile',    [UserController::class,'update_profile'])->name('user.profile.update');
    Route::get ('/settings',   [UserController::class,'user_settings'])->name('user.settings');
    Route::post('/update-password', [UserController::class, 'update_password'])->name('user.update.password');
    Route::post('/deactivate', [UserController::class, 'deactivate_account'])->name('user.deactivate');
    Route::post('/delete', [UserController::class, 'delete_account'])->name('user.delete');
    Route::post('/toggle-active', [UserController::class, 'toggle_active'])->name('user.toggle_active');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markRead'])
     ->name('notifications.markRead');

});



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

Route::get('/message/{identifier?}',[MessageController::class,'message_page'])->name('message.page');
Route::post('/message/{identifier}',[MessageController::class,'send_message'])->name('send.message');
Route::middleware('auth')->group(function () {
    Route::delete('/messages/delete/{id}', [MessageController::class, 'delete_message'])->name('messages.delete');
    Route::post('/messages/mark-read/{id}', [MessageController::class, 'markRead'])->name('messages.markRead');
});

