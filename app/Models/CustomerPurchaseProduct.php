<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPurchaseProduct extends Model
{
    protected  $table = 'customer_purchase_products';
    protected $dates = ['deleted_at'];
    protected $fillable=['customer_id','product_id','office_id','purchase_date','remarks','created_by','updated_by','deleted_by'];
    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function campaign(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function office(){
        return $this->belongsTo('App\Models\Configurations\Office','office_id','id');
    }
}
