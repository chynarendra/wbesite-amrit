<?php

namespace App\Http\Controllers\SystemSetting;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ResourceController;
use App\Http\Requests\SystemSetting\LoginSettingRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\SystemSetting;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class LoginSettingController extends BaseController
{
    private $model;
    private $logMenu = 22;
    private $table = 'system_settings';
    private $resource;
    private $viewFile = 'backend.systemSetting.loginSetting';
    private $commonRepository;
    //set file path variable
    private $filePath = 'uploads/files';
    //set file width
    private $fileWidth = '';
    //set file height
    private $fileHeight = '';

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
        $data['page_title'] = 'Login Setting';
        $data['page_url'] = 'systemSetting/loginSetting';
        $data['page_route'] = 'loginSetting';
        $data['file_upload_url'] = 'systemSetting/uploadSystemSettingFile';
        $data['status_url'] = 'systemSetting/updateStatus';
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
    public function update(LoginSettingRequest $request, $id)
    {
        //check all data from request form
        $data = $request->all();
        //check existing value
        $value = $this->commonRepository->findById($this->model, $id);
        //check image form request
        if (!empty($request->file('login_background_image'))) {
            if (!empty($request->file('login_background_image'))) {
                $data['login_background_image'] = $this->resource->setFileUploadName($request->login_background_image, $request->login_title);
                $imageSuccess = true;
            }
        }
        $update = $this->resource->update($this->model, $id, $data, $this->logMenu);
        if ($update) {
            if ($value->image != null) {
                $this->resource->deleteExistingFile($value->login_background_image, $this->filePath);
            }
            if (isset($imageSuccess)) {
                $this->resource->setFileUploadPath($request->login_background_image, $data['login_background_image'], $this->filePath, $this->fileWidth, $this->fileHeight);
            }
        }
        return $update;

    }
    /* delete existing file */
    public function destroy($id , Request $request)
    {
        $response = $this->resource->deleteUploadedFile($this->model,$id ,$request->column_name,$this->filePath, $this->logMenu);
        return $response;
    }

    //* update  status  form user request */
    public function updateStatus($id , Request $request)
    {
        try {
            $id = (int)$id;
            $value = DB::table($this->table)->find($id);
            if ($value) {
                DB::table($this->table)->where('id',$id)->update([$request->column_name =>$request->status]);
                $this->resource->createLog($value->id, $this->logMenu, 2, '');
                session()->flash('success', Lang::get('app.statusUpdate'));
            }else{
                session()->flash('error', Lang::get('app.errorStatusMessage'));
            }
            return back();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }

    }

}
