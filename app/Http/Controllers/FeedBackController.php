<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CusomerQueryRequest;
use App\Models\Configurations\SourceQuery;
use App\Models\CustomerQuery;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 28;
    private $resource;
    private $table = 'campaign';
    private $viewFile = 'backend.customer.customer_query.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $productCategory;

    public function __construct(CustomerQuery $model, SourceQuery $parentModel,
                                ResourceController $resource, CommonRepository $commonRepository, SearchDataRepository $searchDataRepository)
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
        $data['page_title'] = 'Customer Query';
        $data['page_url'] = 'query';
        $data['page_route'] = 'query';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'query',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'query',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* open create  form from user request*/
    public function create()
    {
        $data['page_title'] = 'Customer Query Add';
        $data['page_url'] = 'query';
        $data['page_route'] = 'query';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $response = $this->resource->create('backend.customer.customer_query.create',$data);
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CusomerQueryRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $this->resource->store($this->model,$data, $this->logMenu);
        if($request->submit == 2){
            return redirect(url('query/create'));
        }
        return redirect(url('query'));

    }
    public function edit($id)
    {
        $data['page_title'] = 'Customer Query Edit';
        $data['page_url'] = 'query';
        $data['page_route'] = 'query';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->edit($this->model, $id, $data ,'backend.customer.customer_query.edit');
        return $response;

    }

    public function show($id)
    {
        $data['page_title'] = 'Customer Query  Details';
        $data['page_url'] = 'query';
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->show($this->model, $id, $data ,'backend.customer.customer_query.show');
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CusomerQueryRequest $request, $id)
    {
        $data  = $request->all();
        $data['updated_by']  = Auth::user()->id;
        $this->resource->update($this->model, $id, $data, $this->logMenu);
        return redirect(url('query'));

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
