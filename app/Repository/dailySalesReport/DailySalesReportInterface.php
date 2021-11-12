<?php

namespace App\Repository\dailySalesReport;

interface DailySalesReportInterface
{
    public function getLatestSalesPersonDetail($id,$pageSize);
    public function getSalesPersonDetail($id);
    public function getClientDetail($id);
    public function getClientDetailByPhone($number);
    public function countClientsBySales($request,$id);

}