<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'sales_report_id','name','address','contact_no','no','tds','status_id','remarks','next_date_of_visit'
    ];
}
