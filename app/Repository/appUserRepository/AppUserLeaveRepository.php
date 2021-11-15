<?php

namespace App\Repository\appUserRepository;

use App\Models\AppUserLeave;
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

    public function __construct(AppUserLeave $appUserLeave,FiscalYearInterface $fiscalYearInterface){

        $this->appUserLeave = $appUserLeave;
        $this->fiscalYearInterface = $fiscalYearInterface;
    }
    public function all()
    {
       return $this->appUserLeave->all();
    }

    public function getLeavesByUser($id)
    {
        $currentFiscalYear=$this->fiscalYearInterface->getCurrentFiscalYear();
        dd($currentFiscalYear);
        $leaves=$this->appUserLeave
            ->where('app_user_id',$id)
            ->whereBetween('month_start_date',[$currentFiscalYear->start_date,$currentFiscalYear->end_date])->get();
        return $leaves;
    }

    public function findById($id)
    {
        return $this->appUserLeave->findById($id);
    }

}