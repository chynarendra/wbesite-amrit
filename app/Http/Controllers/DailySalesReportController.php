<?php

namespace App\Http\Controllers;

use App\Repository\appUserRepository\AppUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repository\DailySalesReportRepository;
use App\Http\Controllers\ResourceController;
use App\Repository\CommonRepository;
use App\Models\Configurations\Office;
use App\Models\ClientDetail;
use App\Models\API\AppUser;
use App\Models\DailySalesReport;

class DailySalesReportController extends BaseController
{
    //
    private $dailySalesReportRepository;
    private $resource;
    private $viewFile = 'backend.dailySalesReport.index';
    private $commonRepository;
    private $office;
    private $clientDetail;
    private $appUser;
    private $dailySalesReport;
    /**
     * @var AppUserRepository
     */
    private $appUserRepository;

    public function __construct(DailySalesReportRepository $dailySalesReportRepository,
    ResourceController $resource,CommonRepository $commonRepository,Office $office,
    ClientDetail $clientDetail,DailySalesReport $dailySalesReport,AppUser $appUser,AppUserRepository $appUserRepository){
        $this->dailySalesReportRepository=$dailySalesReportRepository;
        $this->resource=$resource;
        $this->commonRepository=$commonRepository;
        $this->office=$office;
        $this->dailySalesReport=$dailySalesReport;
        $this->clientDetail=$clientDetail;
        $this->appUser=$appUser;
        $this->appUserRepository = $appUserRepository;
    }

    public function index(Request $request)
    {
        $data['page_title'] = 'Sales Staff';
        $data['page_url'] = '/dsr';
        $data['page_route'] = 'dsr';
        $data['request'] = $request;
        $data['results']=$this->dailySalesReportRepository->getAppUsers($request);
        $data['officeList'] = $this->commonRepository->allList($this->office, 'id','asc');
        return $this->resource->index($this->viewFile, $data);
    }

    public function clients(Request $request,$salesPersonId){
        $data['page_title'] = 'Daily Sales Report';
        $data['page_url'] = '/dsr/'.$salesPersonId.'/clients';
        $data['page_route'] = 'dsr';
        $data['request'] = $request;
        $data['sales_person']=$this->appUserRepository->findUserById($salesPersonId);
        $data['results']=$this->dailySalesReportRepository->getClientsBySalesPerson($request,$salesPersonId);
        $data['officeList'] = $this->commonRepository->allList($this->office, 'id','asc');
        return $this->resource->index('backend.dailySalesReport.clients', $data);
    }

    public function show($id)
    {
        $data['page_title'] = 'Client Details';
        $data['page_url'] = 'dsr';
        $data['page_route'] = 'dsr';
        $clientDetail=$this->commonRepository->findById($this->clientDetail ,$id);
        $data['details'] =$clientDetail;
        $data['appUserDetail']=$this->commonRepository->findById($this->appUser,$clientDetail->app_user_id);

        $response = $this->resource->show($this->clientDetail, $id, $data ,'backend.dailySalesReport.show');
        return $response;

    }

    public function statusChange(Request $request){
        try{
            $data = $request->all();
            $client = $this->commonRepository->findById($this->clientDetail,$request->client_id);

            if($client){
                $client->status_id = $request->status_id;
                $update=$client->save();

                if($update){                  
                    session()->flash('success','Status successfully changed!.');
                    return back();
                }else{
                    session()->flash('error','Status could not be changed!');
                    return back();
                }
            }

        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
            return back();
        }
    }
}
