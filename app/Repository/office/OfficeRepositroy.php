<?php

namespace App\Repository\office;

use App\Models\Configurations\Office;

class OfficeRepositroy implements OfficeInterface
{
    public function __construct(){

    }

    public function getOffices()
    {
        $offices=Office::where('status',1)->get();
        return $offices;
    }

    public function findById($id)
    {
        $office=Office::find($id);
        return $office;
    }

    public function getHeadOfficeDetail()
    {
        $office=Office::where('office_type_id',1)->select('id','office_name','office_address',
            'office_phone','office_fb','office_website')->first();
        return $office;
    }

}