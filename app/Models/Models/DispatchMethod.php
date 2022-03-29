<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchMethod extends Model
{
    protected $fillable = [
        'METHOD_CD',
        'ABBR',
        'DESC_ENG',
        'DESC_NEP',
        'DISABLED',
        'ORDER_NO',
        'ENTERED_BY',
        'ENTERED_DT',
    ];
}
