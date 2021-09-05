<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    protected $table = 'fiscal_years';
    protected $dates = ['deleted_at'];
    protected $fillable=['code','start_date','end_date','status'];
}
