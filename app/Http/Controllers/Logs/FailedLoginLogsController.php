<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceController;
use App\Models\Logs\LoginFails;
use App\Models\User;
use App\Repository\CommonRepository;
use App\Repository\LogRepository;
use Illuminate\Http\Request;

class FailedLoginLogsController extends BaseController
{
    private $logRepository;
    private $commonRepository;
    private $logMenu = 6;
    private $userModel;
    private $resource;
    private $viewFile = 'backend.logs.failLogin';
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
        $data['results'] = $this->logRepository->getAllLoginFails($request);
        $data['totalLogs'] = $this->logRepository->getTotalLoginFails($request);
        $data['page_title'] = 'Failed Logs';
        $data['request'] = $request;
        return $this->resource->index($this->viewFile, $data);
    }
    /* unblock ip address */
    public function ip_unblock($id)
    {
        try {
            $id = (int)$id;
            $value = $this->logRepository->findByLogFailsId($id);
            if ($value) {
                LoginFails::where('log_in_ip', $value->log_in_ip)->where('user_id', '=', NULL)->update(['login_fail_count'=> NULL]);
                //create action log
                $this->resource->createLog($value->id , $this->logMenu , 8 ,'');
                session()->flash('success', 'IP Successfully Unblock!');
                return back();
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }
    }
}
