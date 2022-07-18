<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable=['id','title','subtitle','photo',
    'content','created_date','created_by','status','is_slide'];
}
