<?php

namespace App\Repository\dailySalesReport;

use App\Models\ClientDetail;
use App\Models\DailySalesReport;

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
        $data=$this->dailySalesReport->orderBy('id','DESC')->where('app_user_id',$id)->paginate($pageSize);
        return $data;
    }

    public function getClientDataBySales($id)
    {
        $data=$this->clientDetail
            ->join('customer_status','customer_status.id','client_details.status_id')
            ->select(
                'client_details.id',
                'client_details.sales_report_id',
                'client_details.name',
                'client_details.address',
                'client_details.contact_no',
                'client_details.no',
                'client_details.tds',
                'client_details.remarks',
                'client_details.next_date_of_visit',
                'client_details.created_at',
                'customer_status.name as status'
            )
            ->where('sales_report_id',$id)
            ->orderBy('id','DESC')
            ->paginate(10);
        return $data;
    }

    public function getClientDetail($id){
        $data=$this->clientDetail
            ->join('customer_status','customer_status.id','client_details.status_id')
            ->select(
                'client_details.id',
                'client_details.sales_report_id',
                'client_details.name',
                'client_details.address',
                'client_details.contact_no',
                'client_details.no',
                'client_details.tds',
                'client_details.remarks',
                'client_details.next_date_of_visit',
                'client_details.created_at',
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
}