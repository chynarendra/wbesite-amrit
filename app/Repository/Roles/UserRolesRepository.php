<?php
namespace App\Repository\Roles;

use App\Models\Roles\Menu;
use App\Models\Roles\UserRole;
use App\Models\Roles\UserType;
use Illuminate\Support\Facades\Auth;

class UserRolesRepository
{
    private $userRole;
    private $menu;
    private $userType;

    public function __construct(UserRole $userRole, Menu $menu , UserType $userType)
    {
        $this->userRole = $userRole;
        $this->menu     = $menu;
        $this->userType     = $userType;
    }
    public function copyMenu($type_id)
    {
        if ($type_id != 0) {
            $menus = $this->menu->all();
            foreach ($menus as $menu) {
                if ($this->checkMenu($type_id, $menu->id) == 0) {
                    $this->userRole
                        ->insert(
                            [
                                'user_type_id' => $type_id,
                                'menu_id'       => $menu->id,
                                'allow_view'    => '0',
                                'allow_add'     => '0',
                                'allow_edit'    => '0',
                                'allow_delete'  => '0',
                                'allow_show'  => '0',
                            ]
                        );
                }
            }
        }
    }

    private function checkMenu($type_id, $menu_id)
    {
        return $this->userRole
            ->where('user_type_id', '=', $type_id)
            ->where('menu_id', '=', $menu_id)
            ->count();
    }

    public function changePermission($allowId, $id)
    {
        if ($allowId == 1) {
            $value = $this->userRole
                ->where('id', '=', $id)
                ->select('allow_view')->first();
            if ($value->allow_view == 1) {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_view' => ($value->allow_view == '1') ? '0' : '1','allow_add'=>'0',
                        'allow_edit'=>'0','allow_delete'=>'0','allow_show'=>'0']);
            } else {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_view' => ($value->allow_view == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 2) {
            $value = $this->userRole
                ->where('id', '=', $id)
                ->select('allow_add')->first();
            if ($value->allow_add == 0) {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_add' => ($value->allow_add == '1') ? '0' : '1','allow_view'=>'1']);

            } else {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_add' => ($value->allow_add == '1') ? '0' : '1']);
            }

        } elseif ($allowId == 3) {
            $value = $this->userRole
                ->where('id', '=', $id)
                ->select('allow_edit')->first();
            if ($value->allow_edit == 0) {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_edit' => ($value->allow_edit == '1') ? '0' : '1','allow_view'=>'1']);

            } else {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_edit' => ($value->allow_edit == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 4) {
            $value = $this->userRole
                ->where('id', '=', $id)
                ->select('allow_delete')->first();
            if ($value->allow_delete == 0) {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_delete' => ($value->allow_delete == '1') ? '0' : '1','allow_view'=>'1']);

            } else {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_delete' => ($value->allow_delete == '1') ? '0' : '1']);
            }
        }
        elseif ($allowId == 5) {
            $value = $this->userRole
                ->where('id', '=', $id)
                ->select('allow_show')->first();
            if ($value->allow_show == 0) {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_show' => ($value->allow_show == '1') ? '0' : '1','allow_view'=>'1']);

            } else {
                $this->userRole
                    ->where('id', '=', $id)
                    ->update(['allow_show' => ($value->allow_show == '1') ? '0' : '1']);
            }
        }
    }

    public function typeList(){
        $data = $this->userType;
        //check super admin access
        if (Auth::user()->user_type_id > 1) {
            $data = $data
                ->whereNotIn('id', [1]);
        }
        $data = $data
            ->select('id','type_name')
            ->orderBy('id','DESC')
            ->get();
        return $data;
    }
}
