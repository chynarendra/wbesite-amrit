<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable=['campaign_id','customer_name','reference_source','reference_phone_no','address','contact','email','created_date','status','customer_source_id'];
    public function champaign(){
        return $this->belongsTo('App\Models\Campaign','campaign_id','id');
    }
    public function statusBy(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    public function source(){
        return $this->belongsTo('App\Models\Configurations\SourceQuery','customer_source_id','id');
    }

}
