<?php

namespace App\Repository\Roles;


use App\Models\Roles\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
    private $menu;

    public function __construct(Menu $menu)
    {

        $this->menu = $menu;
    }

    public function all()
    {
        $data = $this->menu
            ->orderBy('menu_order', 'ASC')
            ->paginate(20);
        return $data;
    }

    public function getAccessMenu($id, $type_id)
    {
        $result = DB::table('menus');
        //check super admin admin user type for menu management
        if (Auth::user()->user_type_id > 1) {
            $result = $result
                ->whereNotIn('menus.id', [4]);
        }
        $result = $result
            ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
            ->where('parent_id', $id)
            ->where('menu_status', 1)
            ->where('user_type_id', $type_id)
            ->select(
                'user_roles.id as group_role_id',
                'user_type_id',
                'menu_id',
                'allow_view',
                'allow_add',
                'allow_edit',
                'allow_delete',
                'allow_show',
                'menus.*'
            )
            ->orderBy('menu_order', 'ASC')
            ->get();
        return $result;
    }


    public static function getMenu($id)
    {
        //check super admin admin user type for menu management
        if (Auth::user()->user_type_id == 1) {
            $result = DB::table('menus')
                ->where('parent_id', $id)->where('menu_status', 1)
                ->orderBy('menu_order', 'ASC')
                ->get();
        } else {
            $result = DB::table('menus')->select('menus.*')
                ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
                ->where('parent_id', $id)
                ->where('menu_status', 1)
                ->where('allow_view', 1)
                ->whereNotIn('menus.id', [4])
                ->where('user_type_id', Auth::user()->user_type_id)
                ->orderBy('menu_order', 'ASC')
                ->get();
        }
        return $result;

    }
    public static function getMenus()
    {
        $data =  DB::table('menus')->select('menus.*');
        //check super admin admin user type for menu management
        if(Auth::user()->user_type_id >1){
            $data = $data
                ->whereNotIn('menus.id', [4]);
        }
        $data = $data
            ->join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
            ->where('parent_id', 0)
            ->where('menu_status', 1)
            ->where('allow_view', 1)
            ->where('user_type_id', Auth::user()->user_type_id)
            ->orderBy('menu_order', 'ASC')
            ->get();
        return $data;
    }
    public static function getMenuLink($controllerName){

        $result = DB::table('menus')->select('menu_link','parent_id')->where('menu_controller',$controllerName)->first();
        return  $result ;

    }
}
