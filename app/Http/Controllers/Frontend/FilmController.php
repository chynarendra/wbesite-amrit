<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    //
    public function __construct (){

    }

    public function index(){
        $videos=Video::where('status','1')->get();
        return view('frontend.film.index',compact('videos'));
    }

    public function view($id){
        $video=Video::where('status','1')->find($id);
        return view('frontend.film.view',compact('video'));

    }
}
