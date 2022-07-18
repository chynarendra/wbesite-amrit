<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    use HasFactory;
    protected $fillable=['id','name','parent_menu_id','page_url','module_url','external_url','menu_type','display_order','status'];
}
