<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected  $table = 'city';
    protected $dates = ['deleted_at'];
    protected $fillable=['district_id','city_name','status'];
    public function district(){
        return $this->belongsTo('App\Models\Configurations\District','district_id','id');
    }
}
