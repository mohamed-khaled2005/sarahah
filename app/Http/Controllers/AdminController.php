<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}
