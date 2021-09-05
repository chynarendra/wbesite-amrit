<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeType extends Model
{
    protected $table = 'office_type';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','status'];
}
