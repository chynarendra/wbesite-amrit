<?php

namespace App\Repository\fiscalYear;

interface FiscalYearInterface
{
    public function getCurrentFiscalYear();
    public function getFiscalYearByDate($date);

}