<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\ProductRequest;
use App\Models\Campaign;
use App\Models\Configurations\ProductCategory;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 24;
    private $resource;
    private $table = 'campaign';
    private $viewFile = 'backend.product.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $productCategory;

    public function __construct(Product $model, Campaign $parentModel, ProductCategory $productCategory ,
                                ResourceController $resource, CommonRepository $commonRepository, SearchDataRepository $searchDataRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
        $this->productCategory = $productCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Product';
        $data['page_url'] = '/product';
        $data['page_route'] = 'product';
        $data['champaignList'] = $this->commonRepository->all($this->parentModel, 'campaign_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'product',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'product',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* open create  form from user request*/
    public function create()
    {
        $data['page_title'] = 'Product Add';
        $data['page_url'] = 'product';
        $data['page_route'] = 'product';
        $data['page_title'] = 'Product Add';
        $data['champaignList'] = $this->commonRepository->all($this->parentModel, 'campaign_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $response = $this->resource->create('backend.product.create',$data);
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $this->resource->store($this->model,$data, $this->logMenu);
        if($request->submit == 2){
            return redirect(url('product/create'));
        }elseif ($request->submit == 3){
            return redirect(url('product/create'));
        }
        return redirect(url('product'));

    }
    public function edit($id)
    {
        $data['page_title'] = 'Product Edit';
        $data['page_url'] = 'product';
        $data['page_route'] = 'product';
         $data['champaignList'] = $this->commonRepository->all($this->parentModel, 'campaign_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->edit($this->model, $id, $data ,'backend.product.edit');
        return $response;

    }

    public function show($id)
    {
        $data['page_title'] = 'Product Details';
        $data['page_url'] = 'product';
         $data['champaignList'] = $this->commonRepository->all($this->parentModel, 'campaign_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->show($this->model, $id, $data ,'backend.product.show');
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data  = $request->all();
        $data['updated_by']  = Auth::user()->id;
        $this->resource->update($this->model, $id, $data, $this->logMenu);
        return redirect(url('product'));

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
