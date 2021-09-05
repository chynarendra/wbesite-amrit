<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginLogs extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id','log_in_date','log_in_device','log_in_ip'];


    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
