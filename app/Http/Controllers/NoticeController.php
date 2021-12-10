<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\NoticeRequest;
use App\Models\Configurations\City;
use App\Models\Notice;
use App\Repository\CommonRepository;
use App\Repository\SearchDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoticeController extends BaseController
{
    private $model;
    private $parentModel;
    private $logMenu = 23;
    private $resource;
    private $viewFile = 'backend.notice';
    private $commonRepository;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 10;
    private $searchDataRepository;

    public function __construct(Notice $model, City $parentModel, ResourceController $resource, CommonRepository $commonRepository, SearchDataRepository $searchDataRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->parentModel = $parentModel;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
        $this->searchDataRepository = $searchDataRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Notice';
        $data['page_url'] = '/notice';
        $data['page_route'] = 'notice';
        if ($request->all() != null) {
            $data['results'] = $this->searchDataRepository->getAllSearchData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo, 'notice', $request);
            $data['totalResult'] = $this->searchDataRepository->getSearchDataCount($this->model, 'notice', $request);
        } else {
            $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name, $this->orderBy, $this->paginateNo, '', '1', 'created_at');
        }
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        try {
            $data=$request->all();
            if (isset($data))
                $create = $model->create($data);
            if ($create)

                $res=send_notification_FCM($create->notice_title);

                //create action log
                $this->createLog($create->id, $logMenu, 1, '');
            session()->flash('success', Lang::get('app.insertMessage'));
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeRequest $request, $id)
    {
        $response = $this->resource->update($this->model, $id, $request->all(), $this->logMenu);
        return $response;

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

    public function statusChange(Request $request, $id)
    {
        try {
            $data = $request->all();
            $data['notice_publish_by'] = Auth::user()->id;
            $data['notice_publish_date'] = date('Y-m-d');
            $notice = $this->commonRepository->findById($this->model, $id);

            if ($notice) {
                $notice->notice_status = $request->notice_status;
                $notice->save();
                session()->flash('success', 'Status successfully changed!.');
                return back();
            } else {
                session()->flash('error', 'Status could not be changed!');
                return back();
            }

        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }
}
