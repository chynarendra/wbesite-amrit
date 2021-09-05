<?php

namespace App\Repository;

use App\Models\Customer;
use App\Models\Roles\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartRepository
{
    private $customer;
    public function __construct(Customer $customer)
    {

        $this->customer = $customer;
    }
    //fetch all customer table
    public function getMothWiseCustomerStatus($months=null , $statusType=null)
    {
        $value = getActiveFiscalYearDate();
        $data = $this->customer;
        $data = $data
           ->select(DB::raw("count(id) as totals"), DB::raw("(created_date) as monthname"))
            ->whereMonth('created_date', $months)
            ->where('status', '=', $statusType)
            ->whereBetween('created_date', [$value['start_date'], $value['end_date']])
            ->groupBy('monthname')
            ->get();
        return $data;
    }
}

