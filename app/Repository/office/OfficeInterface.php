<?php

namespace App\Repository\office;

interface OfficeInterface
{
    public function getOffices();
    public function findById($id);
    public function getHeadOfficeDetail();

}