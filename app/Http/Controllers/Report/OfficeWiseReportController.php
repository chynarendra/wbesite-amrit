<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\ResourceController;
use App\Models\ClientDetail;
use App\Models\ClientPurchaseProducts;
use App\Models\Configurations\FiscalYear;
use App\Models\Configurations\Office;
use App\Http\Controllers\BaseController;
use App\Models\CustomerPurchaseProduct;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeWiseReportController extends BaseController
{
    private $model;
    private $resource;
    private $viewFile = 'backend.report.office.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $office;
    private $fiscalYear;

    public function __construct(ClientPurchaseProducts $model,Office $office, SearchDataRepository $searchDataRepository,
                                FiscalYear $fiscalYear, CommonRepository $commonRepository, ResourceController $resource)
    {
        parent::__construct();
        $this->model = $model;
        $this->office = $office;
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
        $data['page_title'] = 'Office Wise Sell Report';
        $data['page_url'] = 'report/officeWiseReport';
        $data['page_route'] = 'officeWiseReport';
        $data['officeList'] = $this->commonRepository->all($this->office, 'office_name', 'asc');
        $officeList=$this->commonRepository->allOfficeListWithRequest($this->office, 'office_name', 'asc',$request);
        $officeWiseSellCount=[];

        foreach($officeList as $office){
            $sellCount=$this->searchDataRepository->countSellsData($this->model,$office->id,$request,'office');
            $newArr['office_name']=$office->office_name;
            $newArr['sell_count']=$sellCount;
            array_push($officeWiseSellCount,$newArr);
        }
        $data['fiscalYearList'] = $this->commonRepository->all($this->fiscalYear, 'id', 'asc');
        $data['results'] =$officeWiseSellCount;
        $data['totalResult'] = $this->searchDataRepository->getSellsData($this->model,$this->orderBy,$this->order_column_name,$this->paginateNo,$request,'1');
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }



}

