<?php
use App\Models\Roles\Menu;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Schema;

function helperPermission()
{
    //get Controller Name
    //get the access from database
    //set variable for add/edit/delete


    $user_type_id = Auth::user()->user_type_id;

    $action = app('request')->route()->getAction();

    /*
     * Splits the controller and store in array
     */
    $controllers = explode("@", class_basename($action['controller']));
    /*
     * Checks the existence of controller and method
     */

    $controller_name = isset($controllers[0]) ? $controllers[0] : '';

    $permission = [
        'isView' => false,
        'isAdd' => false,
        'isEdit' => false,
        'isShow' => false,
        'isDelete' => false];

    $sqlValue = Menu::join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
        ->select('user_roles.*', 'menus.*')
        ->where('user_type_id', '=', $user_type_id)
        ->where('menu_controller', '=', $controller_name)
        ->first();

    if (sizeof(array($sqlValue)) > 0) {

        $isView = $sqlValue->allow_view;
        $isAdd = $sqlValue->allow_add;
        $isEdit = $sqlValue->allow_edit;
        $isDelete = $sqlValue->allow_delete;
        $isShow = $sqlValue->allow_show;
        $permission = [
            'isView' => $isView,
            'isAdd' => $isAdd,
            'isEdit' => $isEdit,
            'isDelete' => $isDelete,
            'isShow' => $isShow];


    }
    return $permission;
}

function helperPermissionLink($addRoute, $viewRoute)
{
    $permission = helperPermission();

    if ($permission['isAdd']) {
        echo '<a href="' . $addRoute . '"  class="float-right boxTopButton" id="add" data-toggle="tooltip" title="Add New"><i class="fa fa-plus-circle fa-2x"></i></a>';
    }
    echo '<a href="' . $viewRoute . '"  class="float-right boxTopButton" data-toggle="tooltip" title="View All"><i class="fa fa-list fa-2x"></i></a>';
    echo '<a href="' .URL::previous(). '" class="float-right boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" ></i></a>';

    return $permission;
}

/*
 * Random Password Generate Function
 */
function rand_string($length)
{

    $chars = "ABC123abc$%456#*EFGHIJ789efghijklmn!mnopqrstKLMNOPQRSTuvwxyzUVWX(YZ)";
    return substr(str_shuffle($chars), 0, $length);

}

function moduleAction($code = null ){

    $value = '';
    if ($code != null) {

        switch ($code) {
            case "1":
                $value = 'Create';
                break;
            case "2":
                $value = 'Update';
                break;
            case "3":
                $value = 'View';
                break;
            case "4":
                $value = 'Delete';
                break;
            case "5":
                $value = 'Status Active';
                break;
            case "6":
                $value = 'Status Inactive';
                break;
            case "7":
                $value = 'User Unblock';
                break;
            case "8":
                $value = 'IP Unblock';
                break;
            case "9":
                $value = 'Update Password';
                break;
            case "10":
                $value = 'Update Profile';
                break;
        }
    } else {

        $value = [

            '1' => 'Create',
            '2' => 'Update',
            '3' => 'View',
            '4' => 'Delete',
            '5' => 'Status Active',
            '6' => 'Status Inactive',
            '7' => 'User Unblock',
            '8' => 'IP Unblock',
            '9' => 'Update Password',
            '10' => 'Update Profile',
        ];
    }
    return $value;
}

function activityMessage($code = null ){

    $value = '';

    switch ($code) {
        case "1":
            $value = 'create';
            break;
        case "2":
            $value = 'update';
            break;
        case "3":
            $value = 'view';
            break;
        case "4":
            $value = 'delete';
            break;
        case "5":
            $value = 'changed status active from
                    inactive';
            break;
        case "6":
            $value = 'changed status inactive from
                    active';
            break;
        case "7":
            $value = 'changed block user from unblock';
            break;
        case "8":
            $value = ' changed block ip from unblock';
            break;
        case "9":
            $value = 'changed your password';
            break;
        case "10":
            $value = 'changed your profile image';
            break;

    }
    return $value;
}

//get device information
function device_info(){
    $agentValue = new Agent();
    $browser = $agentValue->browser();
    $version = $agentValue->version($browser);
    $platform = $agentValue->platform();
    if($agentValue->isDesktop()){
        $device = 'Desktop';
    }elseif($agentValue->isMobile()){
        $device = 'Mobile';
    }elseif($agentValue->isPhone()){
        $device = 'Phone';
    }elseif($agentValue->isTablet()){
        $device = 'Tablet';
    }
    elseif($agentValue->isRobot()){
        $device = 'Robot';
    }
    $deviceInfo = $browser. ' ' .$version. ' ' .$platform. ' ' .$device;
    return $deviceInfo;
}


//get login attempt count
 function  getLoginAttempt()
{
    $data = DB::table('system_settings')
        ->select('login_attempt_limit')
        ->first();
    return $data;
}
//get user login fails  count
function getUserLoginFailed($id)
{
    $data = DB::table('login_fails')
        ->select('login_fail_count')
            ->where([
                ['user_id', '=', $id],
                ['login_fail_count', '<>', NULL],
                ['log_fails_date', '=',date('Y-m-d')]
            ])
            ->count();
    return $data;

}
//get ip login fails  count
function getIpLoginFailed()
{
    $ip = \Request::ip();
    $data = DB::table('login_fails')
        ->select('login_fail_count')
        ->where([
            ['log_in_ip', '=', $ip],
            ['user_id', '=', NULL],
            ['login_fail_count', '<>', NULL],
            ['log_fails_date', '=',date('Y-m-d')]
        ])
        ->count();
    return $data;

}

/* get all system setting */
function systemSetting()
{
    // check table exist
    if(Schema::hasTable('system_settings')){
        $data = DB::table('system_settings')
            ->first();
        return $data;
    }
}

function customerStatus($code = null ){

    $value = '';
    if ($code != null) {

        switch ($code) {
            case "1":
                $value = 'Hot';
                break;
            case "2":
                $value = 'Warm';
                break;
            case "3":
                $value = 'Confirmed';
                break;
            case "4":
                $value = 'Cold';
                break;
            case "5":
                $value = 'Install';
                break;
        }
    } else {

        $value = [

            '1' => 'Hot',
            '2' => 'Warm',
            '3' => 'Confirmed',
            '4' => 'Cold',
            '5' => 'Install',
        ];
    }
    return $value;
}
function englishMonthNames($month = 0)
{
    $monthNames = array(
        1 => 'Jan',
        2 => 'Feb',
        3 => 'Mar',
        4 => 'Apr',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'Aug',
        9 => 'Sep',
        10 => 'Oct',
        11 => 'Nov',
        12 => 'Dec',

    );
    if ($month > 0 && $month <= 12) {
        return $monthNames[$month];
    } else {
        return $monthNames;
    }
}
// get current fiscal year status
function getFYStatus()
{
    $data = DB::table('fiscal_years')
        ->where('status','1')
        ->count();
    return $data;
}
function currentFY()
{
    $data = DB::table('fiscal_years')
        ->where('status','1')
        ->orderBy('id','desc')
        ->first();

    return $data;
}
function getActiveFiscalYearDate()
{
    $getCurrentFiscalYear = currentFY();
    $value = $arrayName = array('start_date' => $getCurrentFiscalYear->start_date ,
        'end_date' => $getCurrentFiscalYear->end_date
    );
    return $value;
}
