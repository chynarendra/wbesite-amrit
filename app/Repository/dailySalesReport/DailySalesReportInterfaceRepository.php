<?php

namespace App\Repository\dailySalesReport;

use App\Models\ClientDetail;
use App\Models\DailySalesReport;
use Carbon\Traits\Date;

class DailySalesReportInterfaceRepository implements DailySalesReportInterface
{
    /**
     * @var DailySalesReportInterface
     */
    private $dailySalesReport;
    /**
     * @var ClientDetail
     */
    private $clientDetail;

    public function __construct(DailySalesReport $dailySalesReport,ClientDetail $clientDetail)
    {
        $this->dailySalesReport = $dailySalesReport;
        $this->clientDetail = $clientDetail;
    }

    public function getLatestSalesPersonDetail($id,$pageSize)
    {

        $cfyStartDate = currentFY()->start_date;
        $cfyEndDate = currentFY()->end_date;

        $data=$this->dailySalesReport
        ->orderBy('id','DESC')
        ->whereBetween('field_visit_date',[$cfyStartDate,$cfyEndDate])
        ->where('app_user_id',$id)
        ->paginate($pageSize);
        return $data;
    }

    public function getClientDataByAppUser($id,$request)
    {
        $clientDetail=$this->clientDetail
            ->join('customer_status','customer_status.id','client_details.status_id')
            ->select(
                'client_details.id',
                'client_details.app_user_id',
                'client_details.name',
                'client_details.address',
                'client_details.contact_no',
                'client_details.no',
                'client_details.tds',
                'client_details.remarks',
                'client_details.status_id',
                'client_details.next_date_of_visit',
                'client_details.date_of_visit',
                'customer_status.name as status'
            );

            if($request->date_of_visit_from !=null){
                if($request->date_of_visit_to !=null){
                    $clientDetail=$clientDetail->whereBetween('client_details.date_of_visit',
                        [$request->date_of_visit_from,$request->date_of_visit_to]);
                }else{
                    $clientDetail=$clientDetail->where('client_details.date_of_visit', $request->date_of_visit_from);
                }

            }
            if($request->status_id !=null){
                $clientDetail=$clientDetail->where('client_details.status_id',$request->status_id);
            }
            if($request->address !=null){
                $clientDetail=$clientDetail->where('client_details.address','like','%'.$request->address);
            }
            $lastDate=date('Y-m-d');
            $firstDate=date('Y-m-d', strtotime($lastDate. ' - 3 days'));

        $clientDetail=$clientDetail
                ->where('app_user_id',$id)
                ->orderBy('id','DESC')
                ->whereBetween('client_details.date_of_visit',[$firstDate,$lastDate])
                ->paginate(10);
            return $clientDetail;
    }

    public function getFollowupClientDataByAppUser($id,$request)
    {
        $clientDetail=$this->clientDetail
            ->join('customer_status','customer_status.id','client_details.status_id')
            ->select(
                'client_details.id',
                'client_details.app_user_id',
                'client_details.name',
                'client_details.address',
                'client_details.contact_no',
                'client_details.no',
                'client_details.tds',
                'client_details.remarks',
                'client_details.status_id',
                'client_details.next_date_of_visit',
                'client_details.date_of_visit',
                'customer_status.name as status'
            );

        $clientDetail=$clientDetail->where('app_user_id',$id)
            ->where('client_details.next_date_of_visit',date('Y-m-d'))
            ->orderBy('id','DESC')
            ->paginate(10);
        return $clientDetail;
    }

    public function getClientDetail($id){
        $data=$this->clientDetail
            ->join('customer_status','customer_status.id','client_details.status_id')
            ->select(
                'client_details.id',
                'client_details.app_user_id',
                'client_details.name',
                'client_details.address',
                'client_details.contact_no',
                'client_details.no',
                'client_details.tds',
                'client_details.remarks',
                'client_details.status_id',
                'client_details.next_date_of_visit',
                'client_details.date_of_visit',
                'customer_status.name as status'
                )
            ->where('client_details.id',$id)
            ->first();
        return $data;
    }

    public function getSalesPersonDetail($id){
        $data=$this->dailySalesReport->find($id);
        return $data;
    }

    public function getClientDetailByPhone($number){
        $data=$this->clientDetail
        ->join('customer_status','customer_status.id','client_details.status_id')
        ->select(
            'client_details.id',
            'client_details.name',
            'client_details.address',
            'client_details.contact_no'
            )
        ->where('client_details.contact_no',$number)
        ->first();
    return $data;
    }

    public function countClientsBySales($request,$id)
    {
        $fromDateOfVisit=$request->from_date_of_visit;
        $toDateOfVisit=$request->to_date_of_visit;
        $clientCount=$this->clientDetail->where('app_user_id',$id);
        if($request->from_date_of_visit !=null){
            if($request->to_date_of_visit !=null){
                $clientCount=$clientCount->whereBetween('date_of_visit',[$fromDateOfVisit,$toDateOfVisit]);
            }else{
                $clientCount=$clientCount->where('date_of_visit',$fromDateOfVisit);
            }
        }
        $clientCount=$clientCount->count();
        return $clientCount;
    }
}