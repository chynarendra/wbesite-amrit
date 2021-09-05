<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Models\Roles\UserRole;
use App\Repository\Roles\MenuRepository;
use App\Repository\Roles\UserRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleAccessController extends BaseController
{
    private $menuRepository;
    private $userRole;
    private $userRolesRepository;
    private $resource;
    private $viewFile = 'backend.roles.roleAccess';

    public function __construct(MenuRepository $menuRepository, UserRole $userRole,
                                UserRolesRepository $userRolesRepository, ResourceController $resource)
    {
        parent::__construct();
        $this->menuRepository = $menuRepository;
        $this->userRole = $userRole;
        $this->resource = $resource;
        $this->userRolesRepository = $userRolesRepository;
    }

    public function index(Request $request)
    {
        $data['typeList'] = $this->userRolesRepository->typeList();
        if ($request->has('type_id')) {
            $type_id = $request->get('type_id');
        } else {
            $type_id = 0;
        }

        if ($request->has('type_id')) {
            $data['menus'] = $this->menuRepository->getAccessMenu(0, $type_id);
        } else {
            $menus = 0;
        }
        $this->userRolesRepository->copyMenu($type_id);
        $data['page_title'] = 'Role Access';
        $data['menuRepo'] = $this->menuRepository;
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }

    public function changeAccess($allowId, $id)
    {
        $this->userRolesRepository->changePermission($allowId, $id);
    }
}
