<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Configurations\CityRequest;
use App\Models\Configurations\City;
use App\Models\Configurations\District;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class CityController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 14;
    private $resource;
    private $table = 'city';
    private $viewFile = 'backend.configurations.city';
    private $commonRepository;
    private $order_column_name = 'city_name';
    private $orderBy = 'asc';
    private $paginateNo = 10;
    private $childTable = 'campaign';
    private $childTableKey = 'city_id';

    public function __construct(City $model, District $parentModel, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
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
        $data['page_title'] = 'City';
        $data['page_url'] = '/systemSetting/city';
        $data['page_route'] = 'city';
        $data['districtList'] = $this->commonRepository->all($this->parentModel, 'name_en', 'asc');
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $response = $this->resource->store($this->model, $request->all(), $this->logMenu);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
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
