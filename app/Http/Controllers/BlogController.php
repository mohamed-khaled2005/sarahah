<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class BlogController extends Controller
{
    public function show($slug=null)
{


$post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();

return view('global.posts.single', [
    'post'=>$post
]);

}
}
