<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\ResourceController;
use App\Models\Configurations\FiscalYear;
use App\Models\Configurations\Office;
use App\Http\Controllers\BaseController;
use App\Models\CustomerPurchaseProduct;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductWiseReportController extends BaseController
{
    private $model;
    private $resource;
    private $viewFile = 'backend.report.product.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $product;
    private $fiscalYear;

    public function __construct(CustomerPurchaseProduct $model,Product $product, SearchDataRepository $searchDataRepository,
                                FiscalYear $fiscalYear, CommonRepository $commonRepository, ResourceController $resource)
    {
        parent::__construct();
        $this->model = $model;
        $this->product = $product;
        $this->searchDataRepository = $searchDataRepository;
        $this->commonRepository = $commonRepository;
        $this->fiscalYear = $fiscalYear;
        $this->resource = $resource;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Product Wise Sell Report';
        $data['page_url'] = 'report/productWiseSellReport';
        $data['page_route'] = 'productWiseSellReport';
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['fiscalYearList'] = $this->commonRepository->all($this->fiscalYear, 'id', 'asc');
        $data['results'] = $this->searchDataRepository->getSellsData($this->model,$this->orderBy,$this->order_column_name,$this->paginateNo,$request);
        $data['totalResult'] = $this->searchDataRepository->getSellsData($this->model,$this->orderBy,$this->order_column_name,$this->paginateNo,$request,'1');
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }



}

