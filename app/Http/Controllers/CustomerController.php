<?php

namespace App\Http\Controllers;

use App\Models\Configurations\Office;
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

class CustomerController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 25;
    private $resource;
    private $viewFile = 'backend.customer.index';
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
    private $office;

    public function __construct(Customer $model, SourceQuery $parentModel, ResourceController $resource, CommonRepository $commonRepository,
                                SearchDataRepository $searchDataRepository, Product $product,
                                ProductCategory $productCategory,Payment $payment, CustomerPurchaseProduct $customerPurchaseProduct,
                                CustomerStatusHistory $statusHistory,Campaign $campaign,Office $office)
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
        $this->office = $office;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Customer';
        $data['page_url'] = 'customer';
        $data['page_route'] = 'customer';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'customer',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'customer',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'','1',$this->data_entery_column);
        }
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* open create  form from user request*/
    public function create()
    {
        $data['page_title'] = 'Customer Add';
        $data['page_url'] = 'customer';
        $data['page_route'] = 'customer';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['officeList'] = $this->commonRepository->all($this->office, 'office_name', 'asc');
        $response = $this->resource->create('backend.customer.create',$data);
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {

        $data = $request->all();
        $data['created_date'] = date('Y-m-d');
        $data['created_by'] = Auth::user()->id;
        $insert = $this->model->create($data);
        $this->resource->createLog($insert->id,$this->logMenu,1);

        // insert customer status history
        $history = [
            'customer_id' => $insert->id,
            'created_by' => Auth::user()->id,
            'status_date' => date('Y-m-d'),
            'followup_date' => $request->followup_date,
            'status_id' => $request->status,

        ];
        CustomerStatusHistory::create($history);

        //insert purchase product

        if($request->status==5){
            return redirect(url('customer/purchaseproduct/'.$insert->id));

        }
//        if($request->product_id !=null && $request->status ==5){
//            $log_array = [];
//            $officeIds =$request->office_id;
//            $pucrchaseDates =$request->purchase_date;
//            $remarks=$request->remarks;
//
//            foreach($request->product_id as $key=>$product)
//            {
//                if(! empty($product))
//                {
//                    $log_array[] = [
//                        'product_id' => $product,
//                        'office_id' => $officeIds[$key],
//                        'purchase_date' => $pucrchaseDates[$key],
//                        'remarks' => $remarks[$key],
//                        'customer_id' => $insert->id,
//                        'created_by' => Auth::user()->id,
//                        'created_at' => Carbon::now()
//                    ];
//                }
//            }
//
//            CustomerPurchaseProduct::insert($log_array);
//        }
        if($request->submit == 2){
            return redirect(url('customer/create'));
        }
        session()->flash('success', Lang::get('app.insertMessage'));
        return redirect(url('customer'));

    }
    public function edit($id)
    {
        $data['page_title'] = 'Customer Edit';
        $data['page_url'] = 'customer';
        $data['page_route'] = 'customer';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');  $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->edit($this->model, $id, $data ,'backend.customer.edit');
        return $response;

    }

    public function show($id)
    {
        $data['page_title'] = 'Customer Details';
        $data['page_url'] = 'customer';
        $data['page_route'] = 'customer';
        $data['sourceList'] = $this->commonRepository->all($this->parentModel, 'name', 'asc');
        $data['campaignList'] = $this->commonRepository->all($this->campaign, 'campaign_name', 'asc');
        $data['productList'] = $this->commonRepository->all($this->product, 'product_name', 'asc');
        $data['productCategoryList'] = $this->commonRepository->all($this->productCategory, 'name', 'asc');
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $data['status_history'] = $this->commonRepository->getDetailById($this->statusHistory ,$id,'customer_id','id','desc',10);
        $data['payments'] = $this->commonRepository->getDetailById($this->payment ,$id,'customer_id','id','desc',10);
        $data['purchased_products'] = $this->commonRepository->getDetailById($this->customerPurchaseProduct ,$id,'customer_id','id','desc',10);
       // dd($data['purchased_products']);

        $response = $this->resource->show($this->model, $id, $data ,'backend.customer.show');
        return $response;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $data  = $request->all();
        $data['updated_by']  = Auth::user()->id;
        $this->resource->update($this->model, $id, $data, $this->logMenu);

        if($request->status==5){
            return redirect(url('customer/purchaseproduct/'.$id));

        }else{
            return redirect(url('customer'));

        }

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
    public function statusChange(Request $request){
        try{
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $data['status_date'] = date('Y-m-d');
            $customer = $this->commonRepository->findById($this->model ,$request->customer_id);

            if($customer){
                $customer->status = $request->status_id;
                $customer->save();
            }
            $create = CustomerStatusHistory::create($data);
            if($create){
                if($request->status_id == 5){

                    session()->flash('success','Status successfully changed!. Please  purchase the new product');
                    return redirect()->route('purchaseProduct.index',$request->customer_id);
                }
                session()->flash('success','Status successfully changed!.');
                return back();
            }else{
                session()->flash('error','Status could not be changed!');
                return back();
            }

        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
            return back();
        }
    }
}

