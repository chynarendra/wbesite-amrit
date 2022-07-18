<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\HeaderMenu;
use App\Models\Page;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderMenuController extends BaseController
{
    private $model;
    private $resource;
    private $table = 'header_menus';
    private $logMenu = 12;
    private $viewFile = 'backend.HeaderMenu.index';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'asc';
    private $paginateNo = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(HeaderMenu $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }

    public function index(Request $request)
    {
        //
        $data['page_title'] = 'Menus';
        $data['page_url'] = '/admin/menus';
        $data['page_route'] = 'menus';
        $data['request'] =$request;
        $data['parent_menus']=$this->model->whereNull('parent_menu_id')->where('status','active')->get();
        $data['menu_type']=['module'=>'Module','url'=>'External Url','page'=>'Page'];
        $data['pages']=Page::where('status','active')->get();
        $data['modules']=['films'=>'Film','photos'=>'Photo','identity'=>'Identity'];
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
    public function store(Request $request)
    {
        //
        $data=$request->all();
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
        $data['page_title'] = 'Header Menu';
        $data['page_url'] = '/admin/menus';
        $data['page_route'] = 'menus';
        $data['parent_menus']=$this->model->whereNull('parent_menu_id')->where('status','active')->get();
        $data['results'] = $this->commonRepository->findById($this->model,$id);
        $data['menu_type']=['module'=>'Module','url'=>'External Url','page'=>'Page'];
        $data['pages']=Page::where('status','active')->get();
        $data['modules']=['film'=>'Film','photo'=>'Photo','identity'=>'Identity'];
        $viewFile='backend.HeaderMenu.view';
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
    public function update(Request $request, $id)
    {
        //
        $data=$request->all();
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
