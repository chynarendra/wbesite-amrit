<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use App\Repository\dailySalesReport\DailySalesReportInterface;
use App\Repository\DailySalesReportRepository;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    //
    /**
     * @var DailySalesReportInterface
     */
    private $dailySalesReportInterface;
    /**
     * @var DailySalesReportRepository
     */
    private $dailySalesReportRepository;
    /**
     * @var AppUserLeaveInterface
     */
    private $appUserLeaveInterface;
    /**
     * @var AppUserInterface
     */
    private $appUserInterface;

    public function __construct(DailySalesReportInterface $dailySalesReportInterface,AppUserInterface $appUserInterface,
                                DailySalesReportRepository $dailySalesReportRepository,AppUserLeaveInterface $appUserLeaveInterface){
        $this->dailySalesReportInterface = $dailySalesReportInterface;
        $this->dailySalesReportRepository = $dailySalesReportRepository;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
        $this->appUserInterface = $appUserInterface;
    }

    public function index($appUserId,Request $request){
        $monthStartDate=$request->month_start_date;
        $monthEndDate=$request->month_end_date;
        $appUser=$this->appUserInterface->findUserById($appUserId);
        $leaveDaysCount=count($this->appUserLeaveInterface->getMonthLeaveDates($appUserId,$monthStartDate,$monthEndDate));
        $holidayDaysCount=count($this->appUserLeaveInterface->getMonthHoildayDates($appUserId,$monthStartDate,$monthEndDate));
        $clients=$this->dailySalesReportRepository->getClientsByAppUser($appUserId,$monthStartDate,$monthEndDate);
        $reportArr=[];
        $oldClientCount=0;
        $newClientCount=0;
        $hotCount=0;
        $warmCount=0;
        $confirmedCount=0;
        $coldCount=0;
        $installedCount=0;
        $totalDays=$this->daysCount($monthStartDate,$monthEndDate);
        $totalWorkDays=$totalDays-$leaveDaysCount-$holidayDaysCount;

        if(sizeof($clients) > 0){
            foreach ($clients as $client){
                if($client->data_type=='old'){
                    $oldClientCount=$oldClientCount+1;
                }
                if($client->data_type=='new'){
                    $newClientCount=$newClientCount+1;
                }
                if($client->status_id==1){
                    $hotCount=$hotCount+1;
                }
                if($client->status_id==2){
                    $warmCount=$warmCount+1;
                }
                if($client->status_id==3){
                    $confirmedCount=$confirmedCount+1;
                }
                if($client->status_id==4){
                    $coldCount=$coldCount+1;
                }
                if($client->status_id==5){
                    $installedCount=$installedCount+1;
                }
            }

        }

        $averageDaysOfVisit=($oldClientCount+$newClientCount)/$totalWorkDays;
        $salesData=$this->getSalesData($appUserId,$monthStartDate,$monthEndDate);
        $monthFormattedStartDate=\Carbon\Carbon::parse($monthStartDate)->format('d M Y');
        $monthFormattedEndDate=\Carbon\Carbon::parse($monthEndDate)->format('d M Y');
        $reportArr['month_start_date']=$monthFormattedStartDate;
        $reportArr['month_end_date']=$monthFormattedEndDate;
        $reportArr['post']=$appUser?$appUser->designation->name:'';
        $reportArr['office']=$appUser?$appUser->office->office_name:'';
        $reportArr['Old']=$oldClientCount;
        $reportArr['New']=$newClientCount;
        $reportArr['Hot']=$hotCount;
        $reportArr['Warm']=$warmCount;
        $reportArr['Confirmed']=$confirmedCount;
        $reportArr['Cold']=$coldCount;
        $reportArr['Installed']=$installedCount;
        $reportArr['Leave']=$leaveDaysCount;
        $reportArr['Holiday']=$holidayDaysCount;
        $reportArr['daily_average_visit']=number_format($averageDaysOfVisit,2);
        $reportArr['total_work_days']=$totalWorkDays;
        $reportArr['sales_status']=$salesData['sales_status'];
        $reportArr['sales_amount']=number_format((float)$salesData['sales_amount'], 2, '.', '');

        $responseBase = new ApiResponse();
        $responseBase->success = true;
        $responseBase->status_code = 200;
        $responseBase->data = $reportArr;
        return response()->json($responseBase);
    }

    function daysCount($date1, $date2)
    {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    public function getSalesData($id,$montStartDate,$monthEndDate){
        $appUser=$this->appUserInterface->findUserById($id);
        $clientPurchasedProducts=$this->dailySalesReportRepository->getClinetPurchaseProductsByAppUser($id,$montStartDate,$monthEndDate);
        $totalSalesAmount=0;
        $reportArr=[];
        if(sizeof($clientPurchasedProducts) > 0){
            foreach ($clientPurchasedProducts as $product){
                $totalSalesAmount=$totalSalesAmount+$product->paid_amount;
            }
        }
        $targetSalesAmount=$appUser->designation->target_sales_amount??0;
        if($targetSalesAmount < $totalSalesAmount){
            $reportArr['sales_status']='good';
        }else{
            $reportArr['sales_status']='poor';
        }
        $reportArr['sales_amount']=$totalSalesAmount;

        return $reportArr;
    }
}
