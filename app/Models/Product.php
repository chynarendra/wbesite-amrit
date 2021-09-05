<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $table = 'products';
    protected $dates = ['deleted_at'];
    protected $fillable=['campaign_id','product_category_id','product_name','warrenty_in_years','about_product'];
    public function category(){
        return $this->belongsTo('App\Models\Configurations\ProductCategory','product_category_id','id');
    }
    public function campaign(){
        return $this->belongsTo('App\Models\Campaign','campaign_id','id');
    }
}
