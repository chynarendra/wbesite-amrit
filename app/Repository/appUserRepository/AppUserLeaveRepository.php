<?php

namespace App\Repository\appUserRepository;

use App\Models\AppUserLeave;
use App\Models\Holiday;
use App\Models\MonthLeaves;
use App\Repository\fiscalYear\FiscalYearInterface;
use App\Repository\fiscalYear\FiscalYearRepository;

class AppUserLeaveRepository implements AppUserLeaveInterface
{
    /**
     * @var AppUserLeave
     */
    private $appUserLeave;
    /**
     * @var FiscalYearInterface
     */
    private $fiscalYearInterface;
    /**
     * @var MonthLeaves
     */
    private $monthLeaves;

    public function __construct(AppUserLeave $appUserLeave,FiscalYearInterface $fiscalYearInterface,MonthLeaves $monthLeaves){

        $this->appUserLeave = $appUserLeave;
        $this->fiscalYearInterface = $fiscalYearInterface;
        $this->monthLeaves = $monthLeaves;
    }
    public function all()
    {
       return $this->appUserLeave->all();
    }

    public function getLeavesByUser($id)
    {
        $currentFiscalYear=$this->fiscalYearInterface->getCurrentFiscalYear();
        $leaves=$this->appUserLeave
            ->where('app_user_id',$id)
//            ->whereBetween('month_start_date',[$currentFiscalYear->start_date,$currentFiscalYear->end_date])
            ->get();
        return $leaves;
    }

    public function findById($id)
    {
        return $this->appUserLeave->findById($id);
    }

    public function getMonthLeaveDates($id, $monthStartDate, $monthEndDate)
    {
        $leaves=$this->monthLeaves
            ->select('leave_date')
            ->whereNotIn('leave_date',function ($query){
                $query->select('holiday_date')->from('holidays');
            })
            ->where('app_user_id',$id)
            ->whereBetween('leave_date',[$monthStartDate,$monthEndDate])
            ->where('status','Approved')
            ->get();

        $dataArr=[];
        if (sizeof($leaves) > 0){
            foreach ($leaves as $leave){
                $dataArr[]=$leave;
            }
        }
        return $dataArr;
    }

    public function getMonthHoildayDates($id, $monthStartDate, $monthEndDate)
    {
        $holidays=Holiday::
        select('holiday_date as leave_date')
            ->whereBetween('holiday_date',[$monthStartDate,$monthEndDate])
            ->get();

        $dataArr=[];
        if (sizeof($holidays) > 0){
            foreach ($holidays as $holiday){
                $dataArr[]=$holiday;
            }
        }
        return $dataArr;
    }

}