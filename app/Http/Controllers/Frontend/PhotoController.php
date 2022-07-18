<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    //
    public function index(){
        $photos=Photo::where('status','1')->where('is_slide','no')->get();
        return view('frontend.photo.index',compact('photos'));
    }

    public function view($id){
        $photo=Photo::where('status','1')->where('is_slide','no')->first();
        return view('frontend.photo.view',compact('photo'));
    }
}
