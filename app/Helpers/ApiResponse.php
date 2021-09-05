<?php

namespace App\Helpers;

class ApiResponse
{
    public function __construct($success = false, $message = '', $code = '',  $data = [])
    {
        $this->success = $success;
        if($message!=null){

            $this->message = $message;
        }
        $this->status_code = $code;
        if($data=null){
            $this->data = $data;
        }
        if($message!=null){
            $this->errors = null;
        }
    }

}

