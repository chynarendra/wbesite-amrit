<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['user_group_id','menu_id','allow_view','allow_add','allow_edit','allow_delete','allow_show'];

    public function user_type(){
        return $this->belongsTo('App\Models\Configurations\UserType','user_type_id','id');
    }
}
