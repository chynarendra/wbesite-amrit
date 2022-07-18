<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
   protected  $table = 'office';
    protected $dates = ['deleted_at'];
    protected $fillable=['office_type_id','office_name','office_address','office_phone','office_fb','office_insta','office_youtube','office_twitter','office_email','about','logo','sub_title','status'];
    public function office_type(){
        return $this->belongsTo('App\Models\Configurations\OfficeType','office_type_id','id');
    }
}
