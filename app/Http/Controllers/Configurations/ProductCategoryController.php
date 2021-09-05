<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\Configurations\DesignationRequest;
use App\Http\Requests\Configurations\ProductCategoryRequest;
use App\Models\Configurations\Designation;
use App\Models\Configurations\ProductCategory;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class ProductCategoryController extends BaseController
{
    private $model;
    private $logMenu = 17;
    private $resource;
    private $table = 'product_category';
    private $childTable = 'products';
    private $childTableKey = 'product_category_id';
    private $viewFile = 'backend.configurations.productCategory';
    private $commonRepository;
    private $order_column_name = 'name';
    private $orderBy = 'asc';
    private $paginateNo = 10;

    public function __construct(ProductCategory $model, ResourceController $resource, CommonRepository $commonRepository)
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
        $data['page_title'] = 'Product Category';
        $data['page_url'] = '/systemSetting/productCategory';
        $data['page_route'] = 'designation';
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
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
    public function update(ProductCategoryRequest $request, $id)
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
