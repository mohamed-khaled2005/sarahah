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
        'emailorusername' => 'required|string',
        'password' => 'required|string',
    ]);

    // نحدد نوع الحقل بناءً على هل المدخل إيميل أم لا
    $fieldType = filter_var($request->emailorusername, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // محاولة واحدة فقط
    if (Auth::attempt([$fieldType => $request->emailorusername, 'password' => $request->password])) {
        // تحقق من نوع المستخدم
        if (Auth::user()->is_admin) {
            return redirect()->route("admin.index");
        } else {
            return redirect()->route("user");
        }
    } else {
        // إعادة الصفحة مع رسالة خطأ
        return back()->withErrors(['emailorusername' => 'خطأ في بيانات الدخول']);
    }
}

    public function sign_up() {
    return view('global.auth.sign_up');
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

    public function logout(Request $request){
           Auth()::logout();
           $request->session()->invalidate();
           $request->session()->regenerateToken();
           return redirect()->route('index');
    }

        public function reset_password() {
    return view('global.auth.reset_password');
}
}
