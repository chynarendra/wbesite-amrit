<?php

namespace App\Repository\appUserRepository;

interface AppUserLeaveInterface
{
    public function all();
    public function getLeavesByUser($id);
    public function findById($id);

}