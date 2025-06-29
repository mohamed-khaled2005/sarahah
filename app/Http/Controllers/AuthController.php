<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function save_user(Request $request){
            $reg_data=$request->validate(
                    [
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

                        ]
            );

            $user=User::Create(
                [
                    "name"=>$reg_data["name"],
                    "username"=>$reg_data["username"],
                    "email"=>$reg_data["email"],
                    "password"=>Hash::make($reg_data["password"]),

                ]
            );
            auth()->login($user);
            return( redirect()->route("index"));
    }
}
