<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\CLientValidation;
use App\Models\Client;
use App\Models\Photo;
use App\Repository\CommonRepository;
use Illuminate\Support\Facades\Auth;

class ClientController extends BaseController
{
    private $model;
    private $resource;
    private $table = 'clients';
    private $logMenu = 12;
    private $viewFile = 'backend.client.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'asc';
    private $paginateNo = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Client $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }
    public function index(Request $request)
    {
        //
        $data['page_title'] = 'CLients';
        $data['page_url'] = '/admin/clients';
        $data['page_route'] = 'clients';
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
    public function store(CLientValidation $request)
    {
        //
         $data=$request->all();
         if($request->hasFile('logo')){
           $file = $request->file('logo');
           $filename = $file->getClientOriginalName();
           $path = storage_path().'/app/public/logo/';
           $file->move($path, $filename);
           $data['logo']='/logo/'.$filename;
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
    public function update(CLientValidation $request, $id)
    {
        //
        $data=$request->all();
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = storage_path().'/app/public/logo/';
           $file->move($path, $filename);
           $data['logo']='/logo/'.$filename;
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
        //
        $client=Client::find($id);
        if($client->logo !=null){
            unlink(storage_path('app/public'.$client->logo));
        }
        
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
