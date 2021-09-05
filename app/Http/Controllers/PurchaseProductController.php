<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CusomerQueryRequest;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PurchaseProductRequest;
use App\Models\Configurations\Office;
use App\Models\Configurations\PaymentMethod;
use App\Models\Customer;
use App\Models\CustomerPurchaseProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseProductController extends Controller
{
    private $model;
    private $parentModel;
    private $logMenu = 29;
    private $resource;
    private $viewFile = 'backend.customer.purchaseProduct.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $product;
    private $office;

    public function __construct(CustomerPurchaseProduct $model, Customer $parentModel, Product $product,
                                ResourceController $resource, CommonRepository $commonRepository,
                                SearchDataRepository $searchDataRepository, Office $office)
    {
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
        $this->product = $product;
        $this->office = $office;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $data['page_title'] = 'Purchase Product Details';
        $data['page_route'] = 'purchaseProduct';
        $data['customer'] = $this->commonRepository->findById($this->parentModel,$id);
        // customer id not found
        if($data['customer'] == null){
            return redirect(url('customer'));
        }
        $data['customerId'] = $id;
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['officeList'] = $this->commonRepository->all($this->office, 'office_name', 'asc');
        $data['purchased_products'] = $this->commonRepository->getDetailById($this->model ,$id,'customer_id','id','desc',10);
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( PurchaseProductRequest $request ,$id)
    {

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['customer_id'] = $id;
        $response = $this->resource->store($this->model,$data, $this->logMenu);
        return $response;


    }
    public function edit($cusId,$id)
    {
        $data['page_title'] = 'Purchase Product  Edit';
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['officeList'] = $this->commonRepository->all($this->office, 'office_name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $data['purchased_products'] = $this->commonRepository->getDetailById($this->model ,$cusId,'customer_id','id','desc',10);
        $data['customer'] = $this->commonRepository->findById($this->parentModel,$cusId);
        $data['customerId'] = $cusId;
        return $this->resource->index($this->viewFile, $data);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseProductRequest $request, $cusId, $id)
    {
        $data  = $request->all();
        $data['updated_by']  = Auth::user()->id;
        $this->resource->update($this->model, $id, $data, $this->logMenu);
        session()->flash('success','Purchase product updated successfully!');

        return redirect()->route('purchaseProduct.index',$cusId);

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
