<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
class StaticPages extends Controller
{

    
    public function index(){
        $posts = Post::all();
    return view('home',
    ['posts'=>$posts]

);

    
}

    public function posts_index() {
        $posts = Post::all();
    return view('global.posts.index',[
        "posts"=>$posts
    ]
);
}


    public function pages() {
    return view('global.pages.single');
}

    public function message_page() {
    return view('global.static.message');
}

}
