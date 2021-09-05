<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CusomerQueryRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Configurations\PaymentMethod;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 29;
    private $resource;
    private $viewFile = 'backend.payment.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;
    private $product;
    private $paymentMethod;

    public function __construct(Payment $model, Customer $parentModel, Product $product, PaymentMethod  $paymentMethod,
                                ResourceController $resource, CommonRepository $commonRepository, SearchDataRepository $searchDataRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
        $this->product = $product;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Payment';
        $data['page_url'] = 'payment';
        $data['page_route'] = 'payment';
        $data['customerList'] = $this->commonRepository->all($this->parentModel, 'customer_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['paymentMethodList'] = $this->commonRepository->all($this->paymentMethod, 'method_name', 'asc');
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'payment',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'payment',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* open create  form from user request*/
    public function create()
    {
        $data['page_title'] = 'Payment Add';
        $data['page_url'] = 'payment';
        $data['page_route'] = 'payment';
        $data['customerList'] = $this->commonRepository->all($this->parentModel, 'customer_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['paymentMethodList'] = $this->commonRepository->all($this->paymentMethod, 'method_name', 'asc');
        $response = $this->resource->create('backend.payment.create',$data);
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $this->resource->store($this->model,$data, $this->logMenu);
        if($request->submit == 2){
            return redirect(url('payment/create'));
        }
        return redirect(url('payment'));

    }
    public function edit($id)
    {
        $data['page_title'] = 'Payment  Edit';
        $data['page_url'] = 'payment';
        $data['page_route'] = 'payment';
        $data['customerList'] = $this->commonRepository->all($this->parentModel, 'customer_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['paymentMethodList'] = $this->commonRepository->all($this->paymentMethod, 'method_name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->edit($this->model, $id, $data ,'backend.payment.edit');
        return $response;

    }

    public function show($id)
    {
        $data['page_title'] = 'Payment Details';
        $data['page_url'] = 'payment';
        $data['page_route'] = 'payment';
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->show($this->model, $id, $data ,'backend.payment.show');
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        $data  = $request->all();
        $data['updated_by']  = Auth::user()->id;
        $this->resource->update($this->model, $id, $data, $this->logMenu);
        return redirect(url('payment'));

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
