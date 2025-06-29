<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class StaticPages extends Controller
{

    
    public function index(){
    return view('home');
}

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

}
