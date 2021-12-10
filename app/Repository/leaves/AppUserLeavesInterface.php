<?php
/**
 * Created by PhpStorm.
 * User: narendra
 * Date: 12/5/21
 * Time: 8:54 PM
 */

namespace App\Repository\leaves;


interface AppUserLeavesInterface
{
    public function currentFiscalYearLeaves($id);
    public function currentFiscalYearHoliday($id);
    public function currentMonthLeavesByUser($id,$monthStartDate,$monthEndDate);
    public function leavesByMonth($startDate,$endDate);
    public function findById($id);
    public function all($request);

}