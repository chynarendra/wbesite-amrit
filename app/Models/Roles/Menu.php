<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['parent_id','menu_name','menu_controller','menu_link','menu_css',
        'menu_icon','menu_status','menu_order','action_module_status'];

    public $timestamps = false;
    public function parent()
    {
        return $this->belongsTo('App\Models\Roles\Menu','parent_id')->where('parent_id',0)->with('parent');
    }
    public function children()
    {
        return $this->hasMany('App\App\Models\Roles\Menu','parent_id');
    }
}
