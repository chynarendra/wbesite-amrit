<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthLeaves extends Model
{
    use HasFactory;
    protected $fillable=['id','app_user_id','status','leave_date','reason'];

    public function appUser(){
        return $this->belongsTo('App\Models\API\AppUser','app_user_id','id');
    }
}
