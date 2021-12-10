<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUserLeave extends Model
{
    use HasFactory;
    protected $fillable=['id','app_user_id','month_start_date','month_end_date'];
}
