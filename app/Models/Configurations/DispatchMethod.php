<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class DispatchMethod extends Model
{
    protected $fillable=['id','METHOD_CD','ABBR','DESC_ENG','DESC_NEP',
        'DISABLED','ORDER_NO','ENTERED_BY','ENTERED_DT'];
}
