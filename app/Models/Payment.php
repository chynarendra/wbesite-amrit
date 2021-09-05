<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected  $table = 'payments';
    protected $dates = ['deleted_at'];
    protected $fillable=['customer_id','product_id','payment_method_id','payment_method_id','paid_date','paid_amount','remarks','created_by','updated_by','deleted_by'];
    public function paymentMethod(){
        return $this->belongsTo('App\Models\Configurations\PaymentMethod','payment_method_id','id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
}
