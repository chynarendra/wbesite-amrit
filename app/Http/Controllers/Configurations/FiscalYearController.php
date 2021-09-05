<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Configurations\FiscalYearRequest;
use App\Models\Configurations\FiscalYear;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class FiscalYearController extends BaseController
{
    private $model;
    private $logMenu = 16;
    private $resource;
    private $table = 'fiscal_years';
    private $viewFile = 'backend.configurations.fiscalYear';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;

    public function __construct(FiscalYear $model, ResourceController $resource, CommonRepository $commonRepository)
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
        $data['page_title'] = 'Fiscal Year';
        $data['page_url'] = '/systemSetting/fiscalYear';
        $data['page_route'] = 'fiscalYear';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FiscalYearRequest $request)
    {
        if ($request->status == '1') {
            $status_count = getFYStatus();
            if($status_count ==1){
                session()->flash('warning', 'Only one fiscal year active at a time');
                return back();
            }
        }
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
    public function update(FiscalYearRequest $request, $id)
    {
        $value = $this->commonRepository->findById($this->model,$id);
        if($value->status == '0' && $request->status == 1){
            $status_count = getFYStatus();
            if($status_count ==1){
                session()->flash('warning', 'Only one fiscal year active at a time');
                return back();
            }
        }
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
            $response = $this->resource->destroy($this->model, $id, $this->logMenu);
            return $response;
    }

    //update status from user request
    public function status($id)
    {
            $id = (int)$id;
            $value = $this->commonRepository->findById($this->model,$id);
            if($value->status == '0'){
                $status_count = getFYStatus();
                if($status_count ==1){
                    session()->flash('warning', 'Only one fiscal year active at a time');
                    return back();
                }
            }
            $response = $this->resource->status($this->table, $id, $this->logMenu);
            return $response;
    }
}
