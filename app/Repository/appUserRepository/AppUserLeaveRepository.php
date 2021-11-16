<?php

namespace App\Repository\appUserRepository;

use App\Models\AppUserLeave;
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
            ->join('app_user_leaves','app_user_leaves.id','month_leaves.app_user_leave_id')
            ->select('month_leaves.leave_date')
            ->where('app_user_leaves.app_user_id',$id)
            ->where('app_user_leaves.month_start_date',$monthStartDate)
            ->where('app_user_leaves.month_end_date',$monthEndDate)
            ->where('month_leaves.leave_type','leave')
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
        $leaves=$this->monthLeaves->join('app_user_leaves','app_user_leaves.id','month_leaves.app_user_leave_id')
            ->select('month_leaves.leave_date')
            ->where('app_user_leaves.app_user_id',$id)
            ->where('app_user_leaves.month_start_date',$monthStartDate)
            ->where('app_user_leaves.month_end_date',$monthEndDate)
            ->where('month_leaves.leave_type','holiday')
            ->get();

        $dataArr=[];
        if (sizeof($leaves) > 0){
            foreach ($leaves as $leave){
                $dataArr[]=$leave;
            }
        }
        return $dataArr;
    }

}