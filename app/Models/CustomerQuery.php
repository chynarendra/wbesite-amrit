<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomerQuery extends Model
{
    protected  $table = 'customer_query';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','address','email','ph_no','source_of_query_id','question'];
    public function source(){
        return $this->belongsTo('App\Models\Configurations\SourceQuery','source_of_query_id','id');
    }
}
