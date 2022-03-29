<?php

namespace App\Repository\fiscalYear;

use App\Models\Configurations\FiscalYear;
use Illuminate\Support\Facades\DB;

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
        $currentFy=DB::table('fiscal_years')
            ->where('start_date','<=',$currentDate)
            ->where('end_date','>=',$currentDate)
            ->where('status','1')
            ->first();
        return $currentFy;
    }

    public function getFiscalYearByDate($date)
    {
        $date=date('Y-m-d',strtotime($date));
        $currentFy=DB::table('fiscal_years')
            ->where('start_date','<=',$date)
            ->where('end_date','>=',$date)
            ->where('status','1')
            ->first();
        return $currentFy;
    }
}