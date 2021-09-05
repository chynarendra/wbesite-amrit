<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Roles\MenuRequest;
use App\Models\Roles\Menu;
use App\Repository\CommonRepository;
use App\Repository\Roles\MenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class MenuController extends BaseController
{

    private $commonRepository;
    private $menuRepository;
    private $model;
    private $logMenu = 4;
    private $resource;
    private $table = 'menus';
    private $childTable = 'menus';
    private $childTable1 = 'user_roles';
    private $childTableKey = 'parent_id';
    private $childTableKey1 = 'menu_id';
    private $viewFile = 'backend.roles.menu';

    public function __construct(Menu $model, CommonRepository $commonRepository,
                                ResourceController $resource, MenuRepository $menuRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->menuRepository = $menuRepository;
        $this->commonRepository = $commonRepository;
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menus'] = $this->menuRepository->all();
        $data['parentList'] = $this->menuRepository->all();
        $data['page_title'] = 'Menu Management';
        return  $this->resource->index($this->viewFile, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $data = $request->all();
        if($data['parent_id'] == null){
            $data['parent_id'] = 0;
        }
        $response = $this->resource->store($this->model, $data , $this->logMenu);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $response = $this->resource->update($this->model,$id, $request->all() , $this->logMenu);
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = $this->resource->checkForeignKey($this->childTable, $id, $this->childTableKey);
        $value1 = $this->resource->checkForeignKey($this->childTable1, $id, $this->childTableKey1);
        if ($value < 1 && $value1 < 1) {
            $response = $this->resource->destroy($this->model,$id, $this->logMenu);
            return $response;
        } else {
            session()->flash('warning', Lang::get('app.warningMessage'));
            return back();
        }
    }

    //check user type  active / inactive status
    public function status($id, Request $request)
    {
        $value = $this->resource->checkForeignKey($this->childTable, $id, $this->childTableKey);
        $value1 = $this->resource->checkForeignKey($this->childTable1, $id, $this->childTableKey1);
        if ($value < 1 && $value1 < 1) {
            $response = $this->resource->status($this->table,$id, $request->status,$this->logMenu);
            return $response;
        } else {
            session()->flash('warning', Lang::get('app.warningStatusMessage'));
            return back();
        }
    }
}
