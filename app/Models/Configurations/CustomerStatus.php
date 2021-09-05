<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
{
    protected $table = 'customer_status';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','status'];
}
