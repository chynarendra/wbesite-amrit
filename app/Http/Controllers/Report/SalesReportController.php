<?php

namespace App\Http\Controllers\Report;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Configurations\Designation;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use App\Repository\CommonRepository;
use App\Repository\dailySalesReport\DailySalesReportInterface;
use App\Repository\DailySalesReportRepository;
use App\Repository\office\OfficeInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    //
    /**
     * @var OfficeInterface
     */
    private $officeInterface;
    /**
     * @var CommonRepository
     */
    private $commonRepository;
    /**
     * @var Designation
     */
    private $designation;

    public function __construct(DailySalesReportInterface  $dailySalesReportInterface, OfficeInterface $officeInterface, AppUserInterface $appUserInterface,
                                DailySalesReportRepository $dailySalesReportRepository, AppUserLeaveInterface $appUserLeaveInterface,
                                CommonRepository $commonRepository,Designation $designation){
        $this->dailySalesReportInterface = $dailySalesReportInterface;
        $this->dailySalesReportRepository = $dailySalesReportRepository;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
        $this->appUserInterface = $appUserInterface;
        $this->officeInterface = $officeInterface;
        $this->commonRepository = $commonRepository;
        $this->designation = $designation;
    }

    public function index(Request $request){
        $page_title='Sales Report';
        $page_url='report/sales';
        $officeList=$this->officeInterface->getOffices();
        $designationList=$this->commonRepository->allList($this->designation,'id','DESC');
        $appUsers=$this->appUserInterface->getAllUsers($request);
        $salesDataArr=[];
        if(sizeof($appUsers) > 0){
            foreach ($appUsers as $user){
                $sales=$this->salesPerformanceByUser($user->id,$request);
                array_push($salesDataArr,$sales);
            }
        }
        return view('backend.report.sales.salesReport',compact('page_title','designationList','request','officeList','salesDataArr','page_url'));
    }
    public function salesPerformanceByUser($appUserId,$request){
        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();
        $monthStartDate=$request->month_start_date??$firstDayofPreviousMonth;
        $monthEndDate=$request->month_end_date??$lastDayofPreviousMonth;
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
        $reportArr['name']=$appUser?$appUser->full_name:'';
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
        return $reportArr;
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
