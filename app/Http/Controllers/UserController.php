<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
