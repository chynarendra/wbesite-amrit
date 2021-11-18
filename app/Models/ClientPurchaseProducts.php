<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPurchaseProducts extends Model
{
    use HasFactory;
    protected $fillable=['id','app_user_id','client_id','product_id','paid_amount','purchase_office_id',
        'purchase_date','remarks','created_by_user_id'];

    public function appUser(){
        return $this->belongsTo('App\Models\API\AppUser','app_user_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function office(){
        return $this->belongsTo('App\Models\Configurations\Office','purchase_office_id','id');
    }

    public function createdUser(){
        return $this->belongsTo('App\Models\User','created_by_user_id','id');
    }
}
