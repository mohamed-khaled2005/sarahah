<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
        public function login() {
    return view('global.auth.login');
}
public function login_user(Request $request) {
    $log_data = $request->validate([
        'emailorusername' => 'required|string|max:255',
        'password' => 'required|string|max:255',
    ]);

    $fieldType = filter_var($log_data['emailorusername'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([$fieldType => $log_data['emailorusername'], 'password' => $log_data['password']])) {
        $request->session()->regenerate(); // حماية session fixation
        if (Auth::user()->is_admin) {
            return redirect()->route("admin.index");
        } else {
            return redirect()->route("user");
        }
    }

    return back()->withErrors([
        'emailorusername' => 'بيانات الدخول غير صحيحة'
    ])->withInput();
}


    public function sign_up() {
    return view('global.auth.sign_up');
}

   public function save_user(Request $request){
    $reg_data = $request->validate([
        'name'     => 'required|string|max:255',
        'username' => [
            'required',
            'string',
            'max:255',
            'unique:users',
            'regex:/^[a-zA-Z0-9_]+$/'
        ],
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        "name" => strip_tags($reg_data["name"]),
        "username" => strip_tags($reg_data["username"]),
        "email" => strip_tags($reg_data["email"]),
        "password" => Hash::make($reg_data["password"]),
    ]);

    auth()->login($user);
    return redirect()->route("index");
}


    public function logout(Request $request){
           Auth::logout();
           $request->session()->invalidate();
           $request->session()->regenerateToken();
           return redirect()->route('index');
    }

        public function reset_password() {
    return view('global.auth.reset_password');
}
}
