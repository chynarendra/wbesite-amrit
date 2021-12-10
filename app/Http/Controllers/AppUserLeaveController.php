<?php

namespace App\Http\Controllers;

use App\Models\AppUserLeave;
use App\Models\MonthLeaves;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AppUserLeaveController extends Controller
{
    /**
     * @param AppUserLeave $appUserLeave
     */
    private $appUserLeave;
    /**
     * @var AppUserLeaveInterface
     */
    private $appUserLeaveInterface;
    /**
     * @var ResourceController
     */
    private $resourceController;
    private $logMenu = 15;

    public function __construct(AppUserLeave $appUserLeave,AppUserLeaveInterface $appUserLeaveInterface,
                                ResourceController $resourceController){
        $this->appUserLeave=$appUserLeave;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
        $this->resourceController = $resourceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $leaves=$this->appUserLeaveInterface->getLeavesByUser($id);
        $appUserRepo=$this->appUserLeaveInterface;
        return view('backend.AppUserLeave.index',compact('leaves','id','appUserRepo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $holidays=$request->holiday;
            $leaves=$request->leave;
            $appUserLeave['app_user_id']=$request->app_user_id;
            $appUserLeave['month_start_date']=$request->month_start_date;
            $appUserLeave['month_end_date']=$request->month_end_date;
            $create = $this->appUserLeave->create($appUserLeave);

            if($create){
                if(isset($holidays) && sizeof($holidays) > 0){
                    foreach ($holidays as $hDay){
                        $monthLeaveData['app_user_leave_id']=$create->id;
                        $monthLeaveData['leave_type']='holiday';
                        $monthLeaveData['leave_date']=$hDay;
                        MonthLeaves::create($monthLeaveData);
                    }

                }

                if(isset($leaves) && sizeof($leaves) > 0){
                    foreach ($leaves as $lDay){
                        $monthHolidayData['app_user_leave_id']=$create->id;
                        $monthLeaveData['leave_type']='leave';
                        $monthLeaveData['leave_date']=$lDay;
                        MonthLeaves::create($monthLeaveData);
                    }

                }
            }

            session()->flash('success', Lang::get('app.insertMessage'));
            return back();

        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->resourceController->destroyLeave($this->appUserLeave, $id, $this->logMenu);
        return $response;
    }
}
