<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class StaticPages extends Controller
{

    
    public function index(){
    return view('welcome');
}
    // login_pages
    public function login() {
    return view('global_pages.login_pages.login');
}
    public function sign_up() {
    return view('global_pages.login_pages.sign_up');
}
    public function reset_password() {
    return view('global_pages.login_pages.reset_password');
}

    // dynamic_pages
    public function blog() {
    return view('global_pages.dynamic_pages.blog');
}
}
