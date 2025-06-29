<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class StaticPages extends Controller
{

    
    public function index(){
    return view('home');
}


    // Global pages

    public function posts_index() {
    return view('global.posts.index');
}
    public function posts_single() {
    return view('global.posts.single');
}
    public function posts_category() {
    return view('global.posts.category');
}
    public function pages() {
    return view('global.pages.single');
}

    public function message_page() {
    return view('global.static.message');
}
    // admin_pages
    public function admin_index() {
    return view('admin.dashboard');
}
    public function admin_users() {
    return view('admin.users');
}
    public function admin_messages() {
    return view('admin.messages');
}
    public function admin_posts() {
    return view('admin.posts');
}
    public function admin_reports() {
    return view('admin.reports');
}
    public function admin_ads() {
    return view('admin.ads');
}
    public function admin_settings() {
    return view('admin.settings');
}

    // User_pages
    public function user_index() {
    return view('user.dashboard');
}
    public function user_inbox() {
    return view('user.inbox');
}
    public function user_profile() {
    return view('user.profile');
}
    public function user_statistics() {
    return view('user.statistics');
}
    public function user_settings() {
    return view('user.settings');
}




}
