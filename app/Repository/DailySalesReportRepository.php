<?php

namespace App\Repository;

use App\Models\API\AppUser;
use App\Models\ClientPurchaseProducts;
use App\Models\DailySalesReport;
use App\Models\User;
use App\Models\ClientDetail;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailySalesReportRepository
{

    private $appUsers;
    private $clientDetail;
    /**
     * @var DailySalesReport
     */
    private $dailySalesReport;
    /**
     * @var AppUserLeaveInterface
     */
    private $appUserLeaveInterface;
    /**
     * @var ClientPurchaseProducts
     */
    private $clientPurchaseProducts;

    public function __construct(AppUser $appUsers, ClientDetail $clientDetail, DailySalesReport $dailySalesReport,
                                AppUserLeaveInterface $appUserLeaveInterface,ClientPurchaseProducts $clientPurchaseProducts)
    {
        $this->appUsers = $appUsers;
        $this->clientDetail = $clientDetail;
        $this->dailySalesReport = $dailySalesReport;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
        $this->clientPurchaseProducts = $clientPurchaseProducts;
    }

    public function getSalesPersons($request)
    {
        $appUsers = $this->getAppUsersByOffice($request);
        $salesPersonList = [];
        if (sizeof($appUsers) > 0) {
            foreach ($appUsers as $appUser) {
                $salesPersons = $this->getSalesPersonsByOffice($appUser->id, $request);
                $salesPersonList[] = $salesPersons;
            }
        }

        return $salesPersonList;
    }

    public function getSalesPersonBy($id){
        $salesPerson=$this->dailySalesReport->find($id);
        return $salesPerson;
    }

    public function getClientsBySalesPerson($request,$id)
    {
        $clients = $this->getClientsByUser($id, $request);
        return $clients;
    }

    public function getAppUsers($request)
    {
        $authUser = Auth::user();
        $appUsers=$this->appUsers;

        if ($authUser->user_type_id > 1) {
            $appUsers = $appUsers->where('office_id', $authUser->office_id);
        }

        if ($request->office_id != null) {
            $appUsers = $appUsers->where('office_id', $request->office_id);
        }

        return $appUsers->paginate(100);
    }

    public function getAppUsersByOffice($request)
    {
        $authUser = Auth::user();

        if ($authUser->user_type_id > 1) {
            $appUsers = AppUser::where('office_id', $authUser->office_id)->get();
        } else {
            $appUsers = AppUser::get();
        }

        if ($request->office_id != null) {
            $appUsers = $appUsers->where('office_id', $request->office_id);
        }

        return $appUsers;
    }

    public function getSalesPersonsByOffice($id,$request)
    {
        $authUser = Auth::user();
        $salesPersons = $this->dailySalesReport
            ->where('app_user_id',$id);

        if ($request->from_date != null) {
            if ($request->to_date != null) {
                $salesPersons = $salesPersons->whereBetween('daily_sales_reports.field_visit_date', [$request->from_date, $request->to_date]);
            } else {
                $salesPersons = $salesPersons->where('daily_sales_reports.field_visit_date', $request->from_date);
            }
        }

        $salesPersons = $salesPersons->orderBy('id', 'DESC')->paginate(100);
        return $salesPersons;
    }

    public function getClientsByUser($id, $request)
    {
        $clients = $this->clientDetail
            ->where('app_user_id', $id);

        if ($request->mobile != null) {
            $clients = $clients->where('client_details.contact_no', $request->mobile);
        }

        if ($request->from_date != null) {
            if ($request->to_date != null) {
                $clients = $clients->whereBetween('client_details.next_date_of_visit', [$request->from_date, $request->to_date]);
            } else {
                $clients = $clients->where('client_details.next_date_of_visit', $request->from_date);
            }
        }

        $clients = $clients->orderBy('client_details.id', 'DESC')->paginate(100);
        return $clients;
    }

    public function getClientsByAppUser($id,$monthStartDate,$monthEndDate)
    {
        $leaveDatesArr=$this->appUserLeaveInterface->getMonthLeaveDates($id,$monthStartDate,$monthEndDate);
        $holidayDatesArr=$this->appUserLeaveInterface->getMonthHoildayDates($id,$monthStartDate,$monthEndDate);
        $clients = $this->clientDetail
            ->where('app_user_id', $id)
            ->whereBetween('date_of_visit',[$monthStartDate,$monthEndDate])
            ->whereNotIn('date_of_visit',$leaveDatesArr)
            ->whereNotIn('date_of_visit',$holidayDatesArr)
            ->orderBy('id','DESC')
            ->get();
        return $clients;
    }

    public function getClientsByAppUserWithStatus($id,$monthStartDate,$monthEndDate)
    {
        $leaveDatesArr=$this->appUserLeaveInterface->getMonthLeaveDates($id,$monthStartDate,$monthEndDate);
        $holidayDatesArr=$this->appUserLeaveInterface->getMonthHoildayDates($id,$monthStartDate,$monthEndDate);
        $clients = $this->clientDetail
            ->select('status_id',DB::raw('count(*) as count'))
            ->where('app_user_id', $id)
            ->whereBetween('date_of_visit',[$monthStartDate,$monthEndDate])
            ->whereNotIn('date_of_visit',$leaveDatesArr)
            ->whereNotIn('date_of_visit',$holidayDatesArr)
            ->groupBy('status_id')
            ->orderBy('id','DESC')
            ->get();
        return $clients;
    }

    public function getClinetPurchaseProductsByAppUser($id,$startDate,$endDate){
        $purchasedProducts=$this->clientPurchaseProducts
            ->where('app_user_id',$id)
            ->whereBetween('purchase_date',[$startDate,$endDate])
            ->get();
        return $purchasedProducts;
    }


}