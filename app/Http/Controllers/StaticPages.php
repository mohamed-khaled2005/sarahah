<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPages extends Controller
{
    public function index(){
    return view('welcome');
}
    public function login() {
    return view('login');
}
    public function sign_up() {
    return view('sign_up');
}
    public function blog() {
    return view('blog');
}

}
