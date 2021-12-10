<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\HolidayValidation;
use App\Models\Holiday;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * @var Holiday
     */
    private $model;
    /**
     * @var ResourceController
     */
    private $resource;
    /**
     * @var CommonRepository
     */
    private $commonRepository;
    private $logMenu = 15;
    private $table = 'holidays';
    private $viewFile = 'backend.configurations.holiday';
    private $order_column_name = 'id';
    private $orderBy = 'asc';
    private $paginateNo = 10;

    public function __construct(Holiday $model, ResourceController $resource, CommonRepository $commonRepository)
    {
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
        //
        $data['page_title'] = 'Holidays';
        $data['page_url'] = '/systemSetting/holiday';
        $data['page_route'] = 'holiday';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayValidation $request)
    {
        //
        $response = $this->resource->store($this->model, $request->all(), $this->logMenu);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $response = $this->resource->update($this->model, $id, $request->all(), $this->logMenu);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $response = $this->resource->destroy($this->model, $id, $this->logMenu);
        return $response;

    }
}
