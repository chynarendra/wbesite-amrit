<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ClientDetail;
use App\Repository\dailySalesReport\DailySalesReportInterface;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    //
    /**
     * @var ClientDetail
     */
    private $clientDetail;
    /**
     * @var DailySalesReportInterface
     */
    private $dailySalesReportInterface;

    public function __construct(ClientDetail $clientDetail,DailySalesReportInterface $dailySalesReportInterface){

        $this->clientDetail = $clientDetail;
        $this->dailySalesReportInterface = $dailySalesReportInterface;
    }

    public function index(Request $request,$id){
        $responseBase = new ApiResponse();
        $dataArr=[];
        $clientCount=$this->dailySalesReportInterface->countClientsBySales($request,$id);

        if($request->data_type=='month'){ // for monthly performance
            $compareRes=($clientCount >= 445)?'Excellent':'Poor';
            $dataArr['message']=($clientCount >= 445)?'Congratulation you have completed the target ! ':'You have not completed the target';
            $dataArr['status']=$compareRes;
        }else{ // for weekly performance
            $compareRes=($clientCount >= 90)?'Excellent':'Poor';
            $dataArr['message']=($clientCount >= 90)?'Congratulation you have completed the target ! ':'You have not completed the target';
            $dataArr['status']=$compareRes;
        }
        $dataArr['count']=$clientCount;
        $dataArr['start_date']=$request->from_date_of_visit;
        $dataArr['end_date']=$request->to_date_of_visit;
        $dataArr['data_type']=$request->data_type;

        $responseBase->success = true;
        $responseBase->status_code = 200;
        $responseBase->data = $dataArr;
        return response()->json($responseBase);

    }
}
