<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','short_name','target_sales','target_sales_amount','status'];
}
