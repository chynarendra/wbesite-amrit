<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthLeaves extends Model
{
    use HasFactory;
    protected $fillable=['id','app_user_leave_id','leave_type','leave_date'];
}
