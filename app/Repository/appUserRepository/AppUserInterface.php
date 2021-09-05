<?php

namespace App\Repository\appUserRepository;

interface AppUserInterface
{
    public function getUserByEmail($request);
    public function getUserByPhoneNo($request);
    public function findUserById($id);

}