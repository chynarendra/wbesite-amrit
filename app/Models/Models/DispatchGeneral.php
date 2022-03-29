<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchGeneral extends Model
{
    protected $fillable = [
        'FISCAL_YR',
        'DISPATCH_NO',
        'DISPATCH_METHOD',
        'DISPATCH_DT_NEP',
        'DISPATCH_DT_ENG',
        'REF_NO',
        'REF_DT_ENG',
        'REF_DT_NEP',
        'ISSUED_TO',
        'ADDRESS',
        'SUBJECT',
        'REMARKS',
        'ENTERED_BY',
        'ENTERED_DT_ENG',
        'ENTERED_DT_NEP',
    ];
}
