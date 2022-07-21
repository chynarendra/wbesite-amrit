<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    //
    public function index(){
        $identities=Identity::where('status','1')->get();
        return view('frontend.identity.index',compact('identities'));
    }

    public function view($id){
        $identity=Identity::find($id);
        return view('frontend.identity.view',compact('identity'));
    }
}
