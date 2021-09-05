<?php

namespace App\Http\Controllers\SystemSetting;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\SystemSetting\EmailSettingRequest;
use App\Models\SystemSetting;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailSettingController extends BaseController
{
    private $model;
    private $logMenu = 21;
    private $resource;
    private $viewFile = 'backend.systemSetting.emailSetting';
    private $commonRepository;

    public function __construct(SystemSetting $model, ResourceController $resource, CommonRepository $commonRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->resource = $resource;
        $this->commonRepository = $commonRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Mail Setting';
        $data['page_url'] = 'systemSetting/mailSetting';
        $data['page_route'] = 'mailSetting';
        $data['result'] = $this->commonRepository->getOnlyData($this->model);
        return $this->resource->index($this->viewFile, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailSettingRequest $request, $id)
    {
        //check all data from request form
        $data = $request->all();
        $update = $this->resource->update($this->model, $id, $data, $this->logMenu);
        return $update;

    }

}
