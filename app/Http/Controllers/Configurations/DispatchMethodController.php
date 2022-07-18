<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\Configurations\DispatchMethod;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Requests\DispatchMethodValidation;

class DispatchMethodController extends BaseController
{
    /**
     * @var CommonRepository
     */
    private $commonRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model;
    private $resource;
    private $logMenu = 16;
    private $viewFile = 'backend.configurations.DispatchMethod.index';
    private $order_column_name = 'ORDER_NO';
    private $orderBy = 'desc';
    private $paginateNo = 100;

    public function __construct(CommonRepository $commonRepository,DispatchMethod $model,ResourceController $resource)
    {
        $this->commonRepository = $commonRepository;
        $this->model = $model;
        $this->resource = $resource;
    }

    public function index()
    {
        //
        $data['page_title'] = 'Dispatch Method';
        $data['page_url'] = '/systemSetting/dispatch';
        $data['page_route'] = 'dispatch';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DispatchMethodValidation $request)
    {
        //
        $response = $this->resource->store($this->model, $request->all(), $this->logMenu);
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
    public function update(DispatchMethodValidation $request, $id)
    {
        $value = $this->commonRepository->findById($this->model,$id);
        $response = $this->resource->update($this->model, $id, $request->all(), $this->logMenu);
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
        //
        $response = $this->resource->destroy($this->model, $id, $this->logMenu);
        return $response;
    }
}
