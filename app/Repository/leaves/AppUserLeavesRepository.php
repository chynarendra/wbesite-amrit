<?php
/**
 * Created by PhpStorm.
 * User: narendra
 * Date: 12/5/21
 * Time: 8:54 PM
 */

namespace App\Repository\leaves;


use App\Models\API\AppUser;
use App\Models\MonthLeaves;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\fiscalYear\FiscalYearInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppUserLeavesRepository implements AppUserLeavesInterface
{
    /**
     * @var FiscalYearInterface
     */
    private $fiscalYearInterface;
    /**
     * @var MonthLeaves
     */
    private $leaves;
    /**
     * @var AppUserInterface
     */
    private $appUserInterface;

    public function __construct(FiscalYearInterface $fiscalYearInterface,MonthLeaves $leaves,AppUserInterface $appUserInterface)
    {

        $this->fiscalYearInterface = $fiscalYearInterface;
        $this->leaves = $leaves;
        $this->appUserInterface = $appUserInterface;
    }

    public function currentFiscalYearLeaves($id)
    {
        $currentFiscalYear=$this->fiscalYearInterface->getCurrentFiscalYear();
        $leaves=$this->leaves
            ->whereBetween('leave_date',[$currentFiscalYear->start_date,$currentFiscalYear->end_date])
            ->where('app_user_id',$id)
            ->where('status','Approved')
            ->get();
        return $leaves;
    }

    public function currentFiscalYearHoliday($id)
    {
        $currentFiscalYear=$this->fiscalYearInterface->getCurrentFiscalYear();
        $leaves=$this->leaves
            ->whereBetween('leave_date',[$currentFiscalYear->start_date,$currentFiscalYear->end_date])
            ->where('app_user_id',$id)
            ->where('status','Approved')
            ->where('leave_type','holiday')
            ->get();
        return $leaves;
    }


    public function currentMonthLeavesByUser($id,$monthStartDate,$monthEndDate)
    {
        $leaves=$this->leaves
            ->select('id','app_user_id','leave_type','reason','leave_date','status')
            ->whereBetween('leave_date',[$monthStartDate,$monthEndDate])
            ->where('app_user_id',$id)
            ->where('leave_type','leave')
            ->get();
        return $leaves;
    }

    public function leavesByMonth($startDate,$endDate)
    {
        $leaves=$this->leaves->whereBetween('leave_date',[$startDate,$endDate])->where('leave_type','leave')->get();
        return $leaves;
    }

    public function all($request)
    {
        $authUser=Auth::user();
        $leaves=$this->leaves;

        if($authUser->user_type_id > 1){
            $appUsersIds=$this->appUserInterface->getUsersByOffice($authUser->office_id); // app users by office
            $leaves=$leaves->whereIn('app_user_id',$appUsersIds);
        }

        if($request->app_user_id !=null){
            $leaves=$leaves->where('app_user_id',$request->app_user_id);
        }

        if($request->status !=null){
            $leaves=$leaves->where('status',$request->status);
        }

        if($request->month_start_date !=null){

            if($request->month_end_date !=null){
                $leaves=$leaves->where('leave_date',[$request->month_start_date,$request->month_end_date]);
            }else{
                $leaves=$leaves->where('leave_date',[$request->month_start_date,$request->month_start_date]);
            }
        }

        $leaves=$leaves->paginate(50);
        return $leaves;
    }

    public function findById($id)
    {
        $leave=$this->leaves->find($id);
        return $leave;
    }

}