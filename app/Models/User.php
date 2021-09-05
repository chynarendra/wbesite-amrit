<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'full_name', 'login_user_name','email', 'password',
        'image', 'status' ,'address' ,'phone_number','block_status','office_id','designation_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_type(){
        return $this->belongsTo('App\Models\Role\UserType','user_type_id','id');
    }
    public function menuIcon(){
        return $this->belongsTo('App\Models\Role\Menu','action_module','id');
    }
    public function designation(){
        return $this->belongsTo('App\Models\Configurations\Designation','designation_id','id');
    }
}
