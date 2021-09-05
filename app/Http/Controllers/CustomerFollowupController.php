<?php

namespace App\Http\Controllers;

use App\Models\Configurations\SourceQuery;
use App\Models\CustomerQuery;
use App\Models\CustomerStatusHistory;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CustomerRequest;
use App\Models\Campaign;
use App\Models\Configurations\ProductCategory;
use App\Models\Customer;
use App\Models\CustomerPurchaseProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CustomerFollowupController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 25;
    private $resource;
    private $viewFile = 'backend.customer.customer_followup.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $product;
    private $data_entery_column='created_date';
    private $productCategory;
    private $payment;
    private $customerPurchaseProduct;
    private $statusHistory;
    private $campaign;

    public function __construct(Customer $model, SourceQuery $parentModel, ResourceController $resource, CommonRepository $commonRepository,
                                SearchDataRepository $searchDataRepository, Product $product, Campaign $campaign,
                                ProductCategory $productCategory,Payment $payment, CustomerPurchaseProduct $customerPurchaseProduct,
                                CustomerStatusHistory $statusHistory)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->payment = $payment;
        $this->customerPurchaseProduct = $customerPurchaseProduct;
        $this->statusHistory = $statusHistory;
        $this->campaign = $campaign;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Customers Followup';
        $data['page_url'] = 'followup';
        $data['page_route'] = 'followup';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        $data['results'] = $this->commonRepository->customerFollowup($this->model,$request);
        $data['totalResult'] = $this->commonRepository->customerFollowupCount($this->model,$request);
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }


    public function show($id)
    {
        $data['page_title'] = 'Customer Followup Details';
        $data['page_url'] = 'followup';
        $data['page_route'] = 'followup';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $data['status_history'] = $this->commonRepository->getDetailById($this->statusHistory ,$id,'customer_id','id','desc',10);
        $data['payments'] = $this->commonRepository->getDetailById($this->payment ,$id,'customer_id','id','desc',10);
        $data['purchased_products'] = $this->commonRepository->getDetailById($this->customerPurchaseProduct ,$id,'customer_id','id','desc',10);
        $response = $this->resource->show($this->model, $id, $data ,'backend.customer.show');
        return $response;

    }
}

