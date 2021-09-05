<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['type_name','details','status'];
    public function users(){
        return $this->hasMany('App\User');
    }
    public function user_roles(){
        return $this->hasMany('App\Models\Configurations\UserRole');
    }
}
