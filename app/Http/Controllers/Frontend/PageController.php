<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index($slug){
        $page=Page::where('slug',$slug)->where('status','1')->first();
        return view('frontend.page',compact('page'));
    }
}
