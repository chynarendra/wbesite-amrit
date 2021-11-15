<?php

namespace App\Repository\fiscalYear;

use App\Models\Configurations\FiscalYear;

class FiscalYearRepository implements FiscalYearInterface
{
    /**
     * @var FiscalYear
     */
    private $fiscalYear;

    public function __construct(FiscalYear $fiscalYear){

        $this->fiscalYear = $fiscalYear;
    }

    public function getCurrentFiscalYear()
    {
        $currentDate=date('Y-m-d');
        $currentFy=$this->fiscalYear
            ->where('start_date','<=',$currentDate)
            ->where('end_date','>=',$currentDate)
            ->where('status',1)
            ->get();
        return $currentFy;
    }
}