<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;


class PageController extends Controller
{
       public function show($slug=null)
{


$page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();

return view('global.pages.single', [
    'page'=>$page
]);

}

}
