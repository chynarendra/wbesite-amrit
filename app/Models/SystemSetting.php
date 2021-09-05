<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemSetting extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=['app_name','app_logo','mail_driver','mail_host_name','mail_port',
        'mail_user_name','mail_password','mail_encryption','mail_from_address','login_attempt_limit','login_title',
        'login_background_image','login_captcha_required', 'forget_password_required', 'login_background_image_display',
    ];
}
