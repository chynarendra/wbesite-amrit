<?php

namespace App\Http\Middleware;

use App\Models\Roles\Menu;
use Closure;
use Illuminate\Support\Facades\Auth;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* Retrieves the action from request and gets the Controller Name and Method Name*/
        $action = app('request')->route()->getAction();

        /*
         * Splits the controller and store in array
         */
        $controllers = explode("@", class_basename($action['controller']));
        /*
         * Checks the existence of controller and method
         */
        $controller_name = isset($controllers[0]) ? $controllers[0] : '';
        $method_name = isset($controllers[1]) ? $controllers[1] : '';


        /*
         *List of controller where permissions are not necessary
         */

        $publicController = ['HomeController'];


        /*
         * checks the controller in array where permission are not allowed
         */
        if (!in_array($controller_name, $publicController)) {

            $user_type_id = Auth::user()->user_type_id;

            /*
             * Joins User Roles and Menus on the basis of user_type_id from user_roles and menu_controller from menus
             */
            $sqlValue = Menu::join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
                ->select('user_roles.*', 'menus.*')
                ->where([
                    ['user_type_id', '=', $user_type_id],
                    ['menu_controller', '=', $controller_name]
                ])
                ->first();

            if (sizeof(array($sqlValue)) == 0 || $sqlValue == null) {
                $this->sorry();
            } else {

                /*
                 * List of method where permissions are checked
                 */
                $arr = ['index', 'create', 'edit', 'destroy', 'show'];

                /*
                 * Search whether the method name exist in the array
                 */
                if (in_array($method_name, $arr)) {

                    $isView = $sqlValue->allow_view;
                    $isAdd = $sqlValue->allow_add;
                    $isEdit = $sqlValue->allow_edit;
                    $isDelete = $sqlValue->allow_delete;
                    $isShow = $sqlValue->allow_show;


                    switch ($method_name) {
                        case  'index':
                            if ($isView != 1) {
                                $this->sorry();

                            }
                            break;
                        case  'create':
                            if ($isAdd != 1) {
                                $this->sorry();
                            }
                            break;
                        case  'edit':
                            if ($isEdit != 1) {
                                $this->sorry();
                            }
                            break;
                        case  'destroy':
                            if ($isDelete != 1) {
                                $this->sorry();
                            }
                            break;
                        case  'show':
                            if ($isShow != 1) {
                                $this->sorry();
                            }
                            break;

                    }
                }
            }
        }

        return $next($request);
    }

    function sorry()
    {
        abort(401);
    }
}
