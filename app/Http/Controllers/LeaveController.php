<?php

namespace App\Http\Controllers;

use App\Models\MonthLeaves;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\leaves\AppUserLeavesInterface;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * @var AppUserLeavesInterface
     */
    private $appUserLeavesInterface;
    /**
     * @var MonthLeaves
     */
    private $monthLeaves;
    /**
     * @var AppUserInterface
     */
    private $appUserInterface;

    public function __construct(AppUserLeavesInterface $appUserLeavesInterface, MonthLeaves $monthLeaves, AppUserInterface $appUserInterface)
    {
        $this->appUserLeavesInterface = $appUserLeavesInterface;
        $this->monthLeaves = $monthLeaves;
        $this->appUserInterface = $appUserInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $leaves = $this->appUserLeavesInterface->all($request);
        $appUsers = $this->appUserInterface->getAllUsers($request);
        $statuses = ['Approved' => 'Approved', 'Cancelled' => 'Cancelled', 'Pending' => 'Pending'];
        $page_url = 'leaves';
        $page_route = 'leaves';
        return view('backend.leave.index', compact('leaves', 'page_route', 'page_url', 'request', 'statuses', 'appUsers'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try {

            $leaveDates = $this->getLeaveDates($request->leave_start_date, $request->leave_end_date);
            $successCount = 0;

            foreach ($leaveDates as $leaveDate) {
                $createArr['app_user_id'] = $request->app_user_id;
                $createArr['status'] = $request->status;
                $createArr['leave_date'] = $leaveDate;
                $createArr['reason'] = $request->reason;

                $create = MonthLeaves::create($createArr);

                if ($create) {
                    $successCount++;
                }
            }

            if ($successCount == sizeof($leaveDates)) {
                session()->flash('success', 'Leave created successfully !');
            }
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        try {

            $leave = MonthLeaves::find($id);

            if ($leave) {
                $update = $leave->fill($request->all())->save();
                session()->flash('success', 'Data updated successfully  !');
            } else {
                session()->flash('error', 'Data not found !');
            }

            return back();

        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $leave = MonthLeaves::find($id);

        if ($leave) {
            $leave->delete();
            session()->flash('success', 'Data deleted successfully  !');
        } else {
            session()->flash('error', 'Data not found !');
        }

        return back();
    }

    public function statusUpdate(Request $request)
    {

        try {
            $data = $request->all();
            if (isset($data))
                $monthLeave = $this->appUserLeavesInterface->findById($request->id);
            $update = $monthLeave->fill($data)->save();
            if ($update)
                session()->flash('success', 'Status updated successfully !');
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    public function getLeaveDates($startDate, $endDate)
    {

        $firstDate = strtotime($startDate);
        $startDay = (int)date('d', $firstDate);

        $lastDate = strtotime($endDate);
        $lastDay = (int)date('d', $lastDate);

        $diff = $lastDay - $startDay;
        $newLeaveDate = $startDate;
        $dateArr = [];
        $dateArr[] = $newLeaveDate;

        for ($i = 1; $i <= $diff; $i++) {
            $newLeaveDate = date('Y-m-d', strtotime('+1 day', strtotime($newLeaveDate)));
            array_push($dateArr, $newLeaveDate);
        }

        return $dateArr;
    }
}
