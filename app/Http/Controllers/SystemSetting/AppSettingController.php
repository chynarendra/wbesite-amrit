<?php

namespace App\Http\Controllers\SystemSetting;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\SystemSetting\AppSettingRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\SystemSetting;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class AppSettingController extends BaseController
{
    private $model;
    private $logMenu = 20;
    private $resource;
    private $viewFile = 'backend.systemSetting.appSetting';
    private $commonRepository;
    //set file path variable
    private $filePath = 'uploads/files';
    //set file width
    private $fileWidth = 128;
    //set file height
    private $fileHeight = 128;

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
        $data['page_title'] = 'App Setting';
        $data['page_url'] = 'systemSetting/appSetting';
        $data['page_route'] = 'appSetting';
        $data['file_upload_url'] = 'systemSetting/uploadSystemSettingFile';
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
    public function update(AppSettingRequest $request, $id)
    {
        //check all data from request form
        $data = $request->all();
        //check existing value
        $value = $this->commonRepository->findById($this->model, $id);
        //check image form request
        if (!empty($request->file('app_logo'))) {
            if (!empty($request->file('app_logo'))) {
                $data['app_logo'] = $this->resource->setFileUploadName($request->app_logo, $request->app_name);
                $imageSuccess = true;
            }
        }
        $update = $this->resource->update($this->model, $id, $data, $this->logMenu);
        if ($update) {
            if ($value->image != null) {
                $this->resource->deleteExistingFile($value->app_logo, $this->filePath);
            }
            if (isset($imageSuccess)) {
                $this->resource->setFileUploadPath($request->app_logo, $data['app_logo'], $this->filePath, $this->fileWidth, $this->fileHeight);
            }
        }
        return $update;

    }
    /* upload  file only */
    public function uploadFile($id, UploadFileRequest $request)
    {
        /* check log menu */
        if($request->logMenu !=null)
            $logMenu = $request->logMenu;
        else
            $logMenu = $this->logMenu;

        $response = $this->resource->updateUploadedFile($this->model,$id ,$request->column_name,$request->update_file,$request->file_title,$this->filePath,$logMenu);
        return $response;
    }
    /* delete existing file */
    public function destroy($id , Request $request)
    {
        $response = $this->resource->deleteUploadedFile($this->model,$id ,$request->column_name,$this->filePath,$this->logMenu);
        return $response;
    }

}
