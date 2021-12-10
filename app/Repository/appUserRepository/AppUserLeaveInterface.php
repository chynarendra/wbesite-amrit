<?php

namespace App\Repository\appUserRepository;

interface AppUserLeaveInterface
{
    public function all();
    public function getLeavesByUser($id);
    public function getMonthLeaveDates($id,$monthStartDate,$monthEndDate);
    public function getMonthHoildayDates($id,$monthStartDate,$monthEndDate);
    public function findById($id);

}