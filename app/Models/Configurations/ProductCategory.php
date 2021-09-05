<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','short_name','status'];
}
