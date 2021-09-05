<?php

namespace App\Repository;
use App\Models\API\AppUser;
use App\Models\User;
use App\Models\ClientDetail;
use Illuminate\Support\Facades\Auth;

class DailySalesReportRepository {

    private $appUsers;
    private $clientDetail;
    public function __construct(AppUser $appUsers,ClientDetail $clientDetail){
        $this->appUsers=$appUsers;
        $this->clientDetail=$clientDetail;
    }

    public function getClients($request){
        $appUsers=$this->getAppUsersByOffice($request);
        $clientList=[];
        if(sizeof($appUsers) > 0){
            foreach($appUsers as $appUser){
                $clients=$this->getClientsByUser($appUser->id,$request);
                $clientList[]=$clients;
            }
        }

        return $clientList;
    }

    public function getAppUsersByOffice($request){
        $authUser=Auth::user();

        if($authUser->user_type_id > 1){
            $appUsers=AppUser::where('office_id',$authUser->office_id)->get();
        }else{
            $appUsers=AppUser::get();
        }

        if($request->office_id !=null ){
            $appUsers=$appUsers->where('office_id',$request->office_id);
        }
        
        return $appUsers;
    }

    public function getClientsByUser($id,$request){
        $clients=$this->clientDetail
        ->join('daily_sales_reports','daily_sales_reports.id','client_details.sales_report_id')
        ->where('daily_sales_reports.app_user_id',$id)
        ->select('client_details.*','daily_sales_reports.app_user_id',
        'daily_sales_reports.visited_by','daily_sales_reports.visited_area',
        'daily_sales_reports.field_visit_date');

        if($request->mobile !=null ){
            $clients=$clients->where('client_details.contact_no',$request->mobile);
        }

        if($request->from_date !=null ){
            if($request->to_date !=null){
                $clients=$clients->whereBetween('client_details.next_date_of_visit',[$request->from_date,$request->to_date]);
            }else{
                $clients=$clients->where('client_details.next_date_of_visit',$request->from_date);
            }
        }
        
        $clients=$clients->orderBy('client_details.id','DESC')->paginate(100);
        return $clients;
    }

}