<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';
    protected $dates = ['deleted_at'];
    protected $fillable=['method_name','status'];
}
