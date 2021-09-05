<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable=['full_name','address','mobile','email','office_id','designation_id',
        'status','register_date','approved_by','approved_date','password','updated_by','deleted_by','block_status'];
    public function office(){
        return $this->belongsTo('App\Models\Configurations\Office','office_id','id');
    }
    public function designation(){
        return $this->belongsTo('App\Models\Configurations\Designation','designation_id','id');
    }
    public function approvedBy(){
        return $this->belongsTo('App\Models\User','approved_by','id');
    }
}
