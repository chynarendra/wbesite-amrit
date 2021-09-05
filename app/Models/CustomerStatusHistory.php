<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStatusHistory extends Model
{
    protected  $table = 'customer_status_history';
    protected $dates = ['deleted_at'];
    protected $fillable=['customer_id','status_id','status_date','followup_date','remarks','created_by'];
    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function status(){
        return $this->belongsTo('App\Models\Configurations\CustomerStatus','status_id','id');
    }
    public function statusBy(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
}
