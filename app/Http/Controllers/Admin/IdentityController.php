<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\IdentityValidation;
use App\Http\Requests\PageValidation;
use App\Models\Identity;
use App\Repository\CommonRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class IdentityController extends BaseController
{
    private $model;
    private $resource;
    private $table = 'identities';
    private $logMenu = 12;
    private $viewFile = 'backend.identity.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'asc';
    private $paginateNo = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Identity $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }

    public function index(Request $request)
    {
        //
        $data['page_title'] = 'Identities';
        $data['page_url'] = '/admin/identities';
        $data['page_route'] = 'identities';
        $data['request'] =$request;
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdentityValidation $request)
    {
        //
        $data=$request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $path = storage_path().'/app/public/identity/';
            $file->move($path, $filename);
            $data['photo']='/identity/'.$filename;
        }
        $data['created_date']=date('Y-m-d');
        $data['created_by']=Auth::user()->id;
        $response = $this->resource->store($this->model, $data, $this->logMenu);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['page_title'] = 'Identities';
        $data['page_url'] = '/admin/identities';
        $data['page_route'] = 'identities';
        $data['results'] = $this->commonRepository->findById($this->model,$id);
        $viewFile='backend.identity.view';
        return $this->resource->show($this->model,$id,$data,$viewFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IdentityValidation $request, $id)
    {
        //
        $data=$request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $path = storage_path().'/app/public/identity/';
            $file->move($path, $filename);
            $data['photo']='/identity/'.$filename;
        }
        $response = $this->resource->update($this->model, $id, $data, $this->logMenu);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->resource->destroy($this->model, $id, $this->logMenu);
        return $response;
    }

    public function status($id)
    {
        $id = (int)$id;
        $response = $this->resource->status($this->table, $id, $this->logMenu);
        return $response;
    }
}
