<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CampaignRequest;
use App\Http\Requests\Configurations\CityRequest;
use App\Models\Campaign;
use App\Models\Configurations\City;
use App\Models\Configurations\District;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 23;
    private $resource;
    private $table = 'campaign';
    private $viewFile = 'backend.campaign';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;

    public function __construct(Campaign $model, City $parentModel, ResourceController $resource, CommonRepository $commonRepository, SearchDataRepository $searchDataRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Campaign';
        $data['page_url'] = '/campaign';
        $data['page_route'] = 'campaign';
        $data['cityList'] = $this->commonRepository->all($this->parentModel, 'city_name', 'asc');
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'champaign',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'champaign',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'','1','created_at');
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
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
    public function update(CampaignRequest $request, $id)
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
        $response = $this->resource->destroy($this->model, $id, $this->logMenu);
        return $response;
    }
}
