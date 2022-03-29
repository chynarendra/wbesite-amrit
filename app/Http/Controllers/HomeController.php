<?php

namespace App\Http\Controllers;
use App\Models\Configurations\CustomerStatus;
use App\Models\User;
use App\Repository\CommonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    private $userModel;
    private $commonRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $userModel,
                                CommonRepository $commonRepository)
    {
        $this->middleware('auth');
        parent::__construct();
        $this->userModel    = $userModel;
        $this->commonRepository    = $commonRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $total_user = $this->commonRepository->getTotalData($this->userModel,'true');
        // high chart
        $customerStatus = CustomerStatus::all();
        $monthNames = englishMonthNames();
        //for month wise
        $customer_month_wise_js_final_data = '';
        $customer_month_wise_js_series_data = '';
        foreach ($customerStatus as $s) {
            $customerStatusId = $s->id;
            $statusName = $s->name;

            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $data[] = isset($res_total[0]->totals) ? $res_total[0]->totals : 0;

            }
            $customer_month_wise_coma_data = implode(", ", $data);
            $customer_month_wise_js_data = 'data : [' . $customer_month_wise_coma_data . ']';
            $month_registration_js_source_data = '{
            name: "' . $statusName . '",
            ' . $customer_month_wise_js_data . '
            },';
            $customer_month_wise_js_final_data .= $month_registration_js_source_data;
        }

        $customer_month_wise_js_series_data = 'series:[
        ' . $customer_month_wise_js_final_data . '
        ]';

        $page_title ='Dashboard';
        return view('backend.dashboard',compact('total_user','page_title','customer_month_wise_js_series_data','monthNames'));
    }

    /* get auth login user activity */
    public function myActivity(Request $request, $id = null)
    {
        $id = (int)$id;

        try {

            if ($id == null) {
                $id = Auth::user()->id;
            }
            //get user value
            $user = $this->commonRepository->findById($this->userModel,$id);
            //get user activity
            $userActivity = $this->commonRepository->getUserActivityById($id, $request)
                ->paginate(200);
            $moduleNames = $this->commonRepository->moduleList();
            return view('backend.users.my-activity', compact('userActivity', 'moduleNames','id' ,'user'));

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }

    }
}
