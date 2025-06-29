<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
        public function login() {
    return view('global.auth.login');
}
    public function sign_up() {
    return view('global.auth.sign_up');
}
    public function reset_password() {
    return view('global.auth.reset_password');
}
}
