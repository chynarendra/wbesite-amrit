<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaign';
    protected $dates = ['deleted_at'];
    protected $fillable=['city_id','campaign_name','attractions','start_date','end_date','description'];
    public function city(){
        return $this->belongsTo('App\Models\Configurations\City','city_id','id');
    }
}
