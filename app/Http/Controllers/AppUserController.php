<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\AppUserRequest;
use App\Http\Requests\ProductRequest;
use App\Models\API\AppUser;
use App\Models\Campaign;
use App\Models\Configurations\Designation;
use App\Models\Configurations\Office;
use App\Models\Configurations\ProductCategory;
use App\Models\Product;
use App\Repository\CommonRepository;
use App\Repository\office\OfficeRepositroy;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class AppUserController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 24;
    private $resource;
    private $viewFile = 'backend.appUser.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 50;
    private $searchDataRepository;
    private $designation;
    /**
     * @var OfficeRepositroy
     */
    private $officeRepositroy;

    public function __construct(AppUser $model, Office $parentModel, Designation $designation ,
                                ResourceController $resource,OfficeRepositroy $officeRepositroy,
                                CommonRepository $commonRepository,
                                SearchDataRepository $searchDataRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
        $this->designation = $designation;
        $this->officeRepositroy = $officeRepositroy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Mobile App User';
        $data['page_url'] = '/appUser';
        $data['page_route'] = 'appUser';
        $data['officeList'] = $this->commonRepository->all($this->parentModel, 'office_name', 'asc');
        $data['designationList'] = $this->commonRepository->all($this->designation, 'name', 'asc');
        $data['status'] = [
            '0'=>'Pending',
            '1'=>'Approved',
        ];
        if($request->all() !=null){
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo,'app',$request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model,'app',$request);
        }else{
            $data['results'] = $this->commonRepository->getAllDSRData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo);
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* open create  form from user request*/
    public function create()
    {
        $data['page_title'] = 'Product Add';
        $data['page_url'] = 'appUser';
        $data['page_route'] = 'appUser';
        $data['page_title'] = 'Product Add';
        $data['officeList'] = $this->commonRepository->all($this->parentModel, 'office_name', 'asc');
        $data['designationList'] = $this->commonRepository->all($this->designation, 'name', 'asc');
        $response = $this->resource->create('backend.product.create',$data);
        return $response;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppUserRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $this->resource->store($this->model,$data, $this->logMenu);
        if($request->submit == 2){
            return redirect(url('appUser/create'));
        }elseif ($request->submit == 3){
            return redirect(url('appUser/create'));
        }
        return redirect(url('appUser'));

    }
    public function edit($id)
    {
        $data['page_title'] = 'Product Edit';
        $data['page_url'] = 'product';
        $data['page_route'] = 'product';
        $data['officeList'] = $this->commonRepository->all($this->parentModel, 'campaign_name', 'asc');
        $data['designationList'] = $this->commonRepository->all($this->designation, 'name', 'asc');
        $data['edits'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->edit($this->model, $id, $data ,'backend.product.edit');
        return $response;

    }

    public function show($id)
    {
        $data['page_title'] = 'Mobile App User';
        $data['page_url'] = '/appUser';
        $data['page_route'] = 'appUser';
        $data['details'] = $this->commonRepository->findById($this->model ,$id);
        $response = $this->resource->show($this->model, $id, $data ,'backend.appUser.show');
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppUserRequest $request, $id)
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

    public function approvedUser($id , Request $request)
    {
        try{
            $user = $this->commonRepository->findById($this->model ,$id);
            if($user->status==0){
                $approved_by = Auth::user()->id;
                $approved_date = date('Y-m-d');
                $user->status ='1';
                $user->approved_by = $approved_by;
                $user->approved_date = $approved_date;
                $user->save();

                if($user->email != null){
                    Mail::send('backend.appUser.email.approve-user-email', ['fullName' => $user->full_name], function ($m) use ($user) {
                        $m->to($user->email)->subject('Message');
                    });
                }
                
                session()->flash('success','User Successfully Approved !');
                return back();
            }elseif ($user->status==1){
                $approved_by = Auth::user()->id;
                $approved_date = date('Y-m-d');
                $user->status ='0';
                $user->approved_by = $approved_by;
                $user->approved_date = $approved_date;
                $user->save();
                session()->flash('success','User disabled !');
                return back();
            }
            else{
                session()->flash('error','User could not be approved!');
                return back();
            }

        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
            return back();
        }
    }
}
