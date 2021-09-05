<?php

namespace App\Models\Logs;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class ActionLogs extends Model
{
    protected $fillable = ['action_user_id','action_date','action_device','action_ip','action_module','action_name','action_id','action_url'];


    public function user(){
        return $this->belongsTo('App\Models\User','action_user_id','id');
    }

    public function menuName(){
        return $this->belongsTo('App\Models\Roles\Menu','action_module','id');
    }
}
