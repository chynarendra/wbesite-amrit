<?php

namespace App\Repository\dailySalesReport;

interface DailySalesReportInterface
{
    public function getLatestSalesPersonDetail($id,$pageSize);
    public function getSalesPersonDetail($id);
    public function getClientDataBySales($id);
    public function getClientDetail($id);

}