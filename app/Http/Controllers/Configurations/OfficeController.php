<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Configurations\OfficeRequest;
use App\Models\Configurations\District;
use App\Models\Configurations\Office;
use App\Models\Configurations\OfficeType;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class OfficeController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 12;
    private $resource;
    private $table = 'office';
    private $childTable = 'users';
    private $childTableKey = 'office_id';
    private $viewFile = 'backend.configurations.office';
    private $commonRepository;
    private $order_column_name = 'office_name';
    private $orderBy = 'asc';
    private $paginateNo = 10;
    private $district;

    public function __construct(Office $model, OfficeType $parentModel,  District $district, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->district = $district;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Office';
        $data['page_url'] = '/systemSetting/office';
        $data['page_route'] = 'office';
        $data['officeList'] = $this->commonRepository->all($this->parentModel, 'name','asc');
        $data['districtList'] = $this->commonRepository->all($this->district, 'name_en','asc');
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        $data=$request->all();
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/office/';
            $file->move($path, $filename);
            $data['logo']='/uploads/office/'.$filename;
        }
        $response = $this->resource->store($this->model, $data, $this->logMenu);
        return $response;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, $id)
    {
        $data=$request->all();
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/office/';
            $file->move($path, $filename);
            $data['logo']='/uploads/office/'.$filename;
        }
        $response = $this->resource->update($this->model, $id, $data, $this->logMenu);
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
