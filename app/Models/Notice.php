<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected  $table = 'notices';
    protected $dates = ['deleted_at'];
    protected $fillable=['notice_title','notice_description','notice_file','notice_date','notice_status','notice_publish_date','notice_publish_by','created_by','updated_by','deleted_by','publish_to_office_id'];
    public function publishedBy(){
        return $this->belongsTo('App\Models\User','notice_publish_by','id');
    }
}
