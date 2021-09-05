<?php

namespace App\Models\Configurations;
use Illuminate\Database\Eloquent\Model;

class SourceQuery extends Model
{
    protected $table = 'source_query';
    protected $dates = ['deleted_at'];
    protected $fillable=['name','status'];
}
