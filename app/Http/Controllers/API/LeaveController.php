<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\MonthLeaves;
use App\Repository\leaves\AppUserLeavesInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    //

    /**
     * @var AppUserLeavesInterface
     */
    private $appUserLeavesInterface;

    public function __construct(AppUserLeavesInterface $appUserLeavesInterface)
    {
        $this->appUserLeavesInterface = $appUserLeavesInterface;
    }

    public function getCurrentMonthLeaves($id){
        $responseBase = new ApiResponse();
        $monthFirstDate= new \DateTime('first day of this month');
        $monthLastDate= new \DateTime('last day of this month');
        $formattedMonthStartDate=$monthFirstDate->format('jS, F Y');
        $formattedMonthLastDate=$monthLastDate->format('jS, F Y');
        $monthStartDate=$monthFirstDate->format('Y-m-d');
        $monthEndDate=$monthLastDate->format('Y-m-d');
        $leavesData=$this->appUserLeavesInterface->currentMonthLeavesByUser($id,$monthStartDate,$monthEndDate);
        $leaves=$this->formateLeaves($leavesData);
        $leaveData['month_start_date']=$formattedMonthStartDate;
        $leaveData['month_end_date']=$formattedMonthLastDate;
        $leaveData['leaves']=$leaves;

        if ($leaves != null) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data = $leaveData;
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Data Not Found";
            return response()->json($responseBase);

        }
    }

    public function formateLeaves($leaves){

        foreach ($leaves as $leave){
            $leaveDate= new \DateTime($leave->leave_date);
            $leave->leave_date=$leaveDate->format('jS, F Y');
        }

        return $leaves;
    }

    public function storeLeave(Request $request){

        $responseBase = new ApiResponse();
        $validator = Validator::make($request->all(), [
            'app_user_id' => 'required',
            'leave_date' => 'required',
            'reason' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "status_code" => 422, "message" => $validator->errors()->all()], 422);
        }
        $dateArr=$this->getLeaveDates($request->leave_date);
        $successCount=0;

        foreach ($dateArr as $date){
            $row = [
                'app_user_id' => $request->app_user_id,
                'leave_date' => $date,
                'leave_type' => 'leave',
                'reason' => $request->reason,
                'status' => 'Pending',
            ];
            $leave= MonthLeaves::create($row);
            $successCount++;
        }


        if (sizeof($dateArr)==$successCount) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->message = "Your Leave is submitted";
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Something is wrong";
            return response()->json($responseBase,404);
        }

    }

    public function getLeaveDates($inputDate){

        $inputDates=explode('to',$inputDate);
        $firstDate = strtotime($inputDates[0]);
        $startDay =(int)date('d', $firstDate);

        $lastDate = strtotime($inputDates[1]);
        $lastDay =(int)date('d', $lastDate);
        $diff=$lastDay-$startDay;
        $newLeaveDate=$inputDates[0];
        $dateArr=[];
        $dateArr[]=$newLeaveDate;

        for ($i = 1; $i <= $diff; $i++) {
            $newLeaveDate =date('Y-m-d', strtotime('+1 day', strtotime($newLeaveDate)));
            array_push( $dateArr,$newLeaveDate);
        }

        return $dateArr;
    }
}
