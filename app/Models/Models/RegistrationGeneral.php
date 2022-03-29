<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationGeneral extends Model
{
    protected $fillable = [
        'id',
        'FISCAL_YR',
        'REG_NO',
        'REG_DT_NEP',
        'REG_DT_ENG',
        'REF_NO',
        'REF_DT_ENG',
        'REF_DT_NEP',
        'ISSUED_BY',
        'ADDRESS',
        'SUBJECT',
        'REMARKS',
        'ENTERED_BY',
        'ENTERED_DT_ENG',
        'ENTERED_DT_NEP'
    ];
}
