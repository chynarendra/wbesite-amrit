<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\Client;
use App\Models\Photo;
use App\Models\UserMessage;
use App\Repository\office\OfficeRepositroy;
use Exception;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    private $officeRepositroy;
    private $resource;
    private $logMenu = 12;
    public function __construct(OfficeRepositroy $officeRepositroy,ResourceController $resource)
    {
        $this->officeRepositroy=$officeRepositroy;
        $this->resource=$resource;
    }
    public function index(){
        $sliderPhotos=Photo::where('is_slide','yes')->get();
        $latestPhotos=Photo::where('status','1')->orderBy('id','DESC')->limit(6)->get();
        $clients=Client::where('status','1')->orderBy('id','DESC')->get();
        return view('frontend.index',compact('sliderPhotos','latestPhotos','clients'));
    }

    public function storeMessage(Request $request){
        $data=$request->all();
        $data['created_date']=date('Y-m-d');
        $response = $this->resource->store(new UserMessage(), $data, $this->logMenu);
        return redirect(url('/#contact'));
    }
}
