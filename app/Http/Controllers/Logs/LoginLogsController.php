<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\User;
use App\Repository\CommonRepository;
use App\Repository\LogRepository;
use Illuminate\Http\Request;

class LoginLogsController extends BaseController
{
    private $logRepository;
    private $commonRepository;
    private $userModel;
    private $resource;
    private $viewFile = 'backend.logs.login';
    public function __construct(LogRepository $logRepository, ResourceController $resource,
                                CommonRepository $commonRepository, User $userModel)
    {
        parent::__construct();
        $this->logRepository  = $logRepository;
        $this->commonRepository = $commonRepository;
        $this->userModel = $userModel;
        $this->resource = $resource;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $data['users'] = $this->commonRepository->all($this->userModel , 'full_name','asc','true');
        $data['results'] = $this->logRepository->getAllLoginLog($request);
        $data['totalLogs'] = $this->logRepository->getTotalLoginLog($request);
        $data['request'] = $request;
        $data['page_title'] = 'Login Logs';
        return $this->resource->index($this->viewFile, $data);
    }

}
