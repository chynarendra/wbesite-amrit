<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySalesReport extends Model
{
    use HasFactory;

    protected $fillable=[
        'app_user_id','visited_by','visited_area','serial_number','field_visit_date'
    ];
}
