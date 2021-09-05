<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Roles\UserTypeRequest;
use App\Models\Roles\UserType;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class UserTypeController extends BaseController
{
    private $model;
    private $logMenu = 2;
    private $resource;
    private $table = 'user_types';
    private $childTable = 'users';
    private $childTableKey = 'user_type_id';
    private $viewFile = 'backend.roles.userType';
    private $commonRepository;
    private $order_column_name = 'type_name';
    private $orderBy = 'asc';
    private $paginateNo = 10;

    public function __construct(UserType $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'User Type';
        $data['page_url'] = 'roles/type';
        $data['page_route'] = 'type';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo,'true');
        return $this->resource->index($this->viewFile, $data);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserTypeRequest $request)
    {
        $response = $this->resource->store($this->model, $request->all(), $this->logMenu);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserTypeRequest $request, $id)
    {
        $response = $this->resource->update($this->model, $id, $request->all(), $this->logMenu);
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //check foreign key from child table
        $value = $this->resource->checkForeignKey($this->childTable, $id, $this->childTableKey);
        if ($value < 1) {
            $response = $this->resource->destroy($this->model, $id, $this->logMenu);
            return $response;
        } else {
            session()->flash('warning', Lang::get('app.warningMessage'));
            return back();
        }
    }

    //update status from user request
    public function status($id)
    {
        $id = (int)$id;
        //check foreign key from child table
        $value = $this->resource->checkForeignKey($this->childTable, $id, $this->childTableKey);
        if ($value < 1) {
            $response = $this->resource->status($this->table, $id, $this->logMenu);
            return $response;
        } else {
            session()->flash('warning', Lang::get('app.warningMessage'));
            return back();
        }
    }
}
