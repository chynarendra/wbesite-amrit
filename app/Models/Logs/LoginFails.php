<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class LoginFails extends Model
{
    protected $fillable = ['user_name','fail_password','log_fails_date','log_in_ip','log_in_device','login_fail_count','user_id'];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
