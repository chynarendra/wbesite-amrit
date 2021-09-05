<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ClientDetail;
use App\Models\CustomerPurchaseProduct;
use App\Models\DailySalesReport;
use App\Repository\office\OfficeInterface;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    /**
     * @var OfficeInterface
     */
    private $officeInterface;

    public function __construct(OfficeInterface $officeInterface)
    {
        $this->officeInterface = $officeInterface;
    }
    public function officeWiseSaleProduct(){
        $offices=$this->officeInterface->getOffices();
        $officeWiseSaleData=[];

        if(sizeof($offices) > 0){
            foreach($offices as $office){
                $purchaseProductCount=CustomerPurchaseProduct::where('office_id',$office->id)->count();
                $officeData['office_name']=$office->office_name;
                $officeData['sale_product_count']=$purchaseProductCount;
                array_push($officeWiseSaleData,$officeData);
            }
        }

        $responseBase = new ApiResponse();
        $responseBase->success = true;
        $responseBase->status_code = 200;
        $responseBase->data = $officeWiseSaleData;
        return response()->json($responseBase);
    }

    public function performanceReport($id){
        $dsrs=DailySalesReport::select('id','visited_area','field_visit_date')->where('app_user_id',$id)->paginate(10);
        $dsrWiseData=[];
        if(sizeof($dsrs) > 0){
            foreach ($dsrs as $dsr){
                $clientCount=ClientDetail::where('sales_report_id',$dsr->id)->count();
                $data['visited_area']=$dsr->visited_area;
                $data['field_visit_date']=$dsr->field_visit_date;
                $data['client_num']=$clientCount;
                array_push($dsrWiseData,$data);
            }
        }

        $responseBase = new ApiResponse();
        $responseBase->success = true;
        $responseBase->status_code = 200;
        $responseBase->data = $dsrWiseData;
        return response()->json($responseBase,200);
    }
}
