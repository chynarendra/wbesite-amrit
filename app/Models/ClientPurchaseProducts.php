<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPurchaseProducts extends Model
{
    use HasFactory;
    protected $fillable=['id','app_user_id','client_id','product_id','paid_amount','purchase_office_id',
        'purchase_date','remarks','created_by_user_id'];
}
