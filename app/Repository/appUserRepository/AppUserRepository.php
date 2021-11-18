<?php

namespace App\Repository\appUserRepository;

use App\Models\API\AppUser;
use App\Repository\office\OfficeInterface;

class AppUserRepository implements AppUserInterface
{

   public function getUserByEmail($request)
   {
       $appUser=AppUser::
           join('office','office.id','app_users.office_id')
           ->join('designations','designations.id','app_users.designation_id')
           ->select('app_users.*','office.office_name as office_name','designations.name as designation_name')
           ->where('app_users.email',$request)
           ->where('app_users.status','=','1')
           ->first();
       return $appUser;
   }

    public function getUserByPhoneNo($request)
    {
        $appUser=AppUser::
        join('office','office.id','app_users.office_id')
            ->join('designations','designations.id','app_users.designation_id')
            ->select('app_users.*','office.office_name as office_name','designations.name as designation_name')
            ->where('app_users.mobile',$request)
            ->where('app_users.status','=','1')
            ->first();
        return $appUser;
    }

   public function findUserById($id)
   {
       $appUser=AppUser::join('office','office.id','app_users.office_id')
           ->join('designations','designations.id','app_users.designation_id')
           ->select('app_users.*','office.office_name as office_name','designations.name as designation_name')
           ->where('app_users.id',$id)
           ->where('app_users.status','=','1')
           ->first();
       return $appUser;
   }
}