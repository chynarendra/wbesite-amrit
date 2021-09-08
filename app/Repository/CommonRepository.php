<?php

namespace App\Repository;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CommonRepository
{

    //fetch all data form table without pagination
    public function all($model, $order_column_name, $order, $authCondition = null)
    {
        $data = $model;
        //Check for super admin user
        if (isset($authCondition) && Auth::user()->user_type_id > 1) {
            $data = $data
                ->whereNotIn('id', [1]);
        }
        $data = $data
            ->orderBy($order_column_name, $order)
            ->get();
        return $data;

    }

    public function allList($model, $order_column_name, $order)
    {
        $data = $model;
        $data = $data
            ->orderBy($order_column_name, $order)
            ->get();
        return $data;

    }

    //fetch only data form table
    public function getOnlyData($model, $authCondition = null)
    {
        $data = $model;
        //Check for super admin user
        if (isset($authCondition) && Auth::user()->user_type_id > 1) {
            $data = $data
                ->whereNotIn('id', [1]);
        }
        $data = $data
            ->first();
        return $data;

    }

    //fetch all data form table with pagination
    public function getAllData($model, $order_column_name, $order, $paginateNo, $authCondition = null, $search_status = null,
                               $data_entry_date = null,$authUser = null)
    {
        $data = $model;
        //Check for super admin user
        if ($authCondition != null && Auth::user()->user_type_id > 1) {
            $data = $data
                ->whereNotIn('id', [1]);
        }
        if ($search_status != null) {
            //check active fiscal year
            $cfyStartDate = currentFY()->start_date;
            $cfyEndDate = currentFY()->end_date;
            $data = $data
                ->whereBetween($data_entry_date, [$cfyStartDate, $cfyEndDate]);
        }

        if (isset($authUser) ) {
            $data = $data
                ->whereNotIn('id', [Auth::user()->id]);
        }

        $data = $data
            ->orderBy($order_column_name, $order)
            ->paginate($paginateNo);
        return $data;

    }

    //check id form table
    public function findById($model, $id)
    {

        $data = $model->find($id);
        return $data;
    }

    //count form table
    public function getTotalData($model, $authCondition = null, $search_status = null, $data_entry_date = null)
    {
        $data = $model;
        //Check for super admin user
        if ($authCondition != null && Auth::user()->user_type_id > 1) {
            $data = $data
                ->whereNotIn('id', [1]);
        }
        if ($search_status != null) {
            //check active fiscal year
            $cfyStartDate = currentFY()->start_date;
            $cfyEndDate = currentFY()->end_date;
            $data = $data
                ->whereBetween($data_entry_date, [$cfyStartDate, $cfyEndDate]);
        }
        $data = $data
            ->count();
        return $data;
    }


    public function moduleList()
    {
        $data = DB::table('menus')
            ->select('id', 'menu_name')
            ->where('action_module_status', 1)
            ->get();
        return $data;
    }

    /* get user activity */
    public function getUserActivityById($user_id, $request)
    {
        $result = DB::table('user_activity');

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('activity_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('activity_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('activity_date', '>=', $request->from_date)
                ->where('activity_date', '<=', $request->to_date);
        }

        if ($request->module_name != null) {
            $result = $result
                ->where('activity_module', '=', $request->module_name);
        }
        $result = $result
            ->where([
                ['activity_user_id', '=', $user_id],
                ['deleted_date', '=', null],
                ['activity_date', '<>', null]
            ])
            ->orderBy('activity_date', 'desc');
        return $result;

    }

    /* get customer status history */
    public function getDetailById($model, $parent_id, $parent_column, $order_column_name, $order_column_value, $paginateNo)
    {
        $data = $model;
        $data = $data
            ->where($parent_column, $parent_id)
            ->orderby($order_column_name, $order_column_value)
            ->paginate($paginateNo);
        return $data;

    }

    public function customerFollowup($model, $request)
    {
        /*$data = $model::select('customers.*','customer_status_history.followup_date')
            ->leftJoin('customer_status_history', 'customer_status_history.customer_id', '=', 'customers.id')
            ->whereDate('customer_status_history.followup_date', '=', date('Y-m-d'))
            ->groupBy('customer_status_history.customer_id')
            ->get();
        dd($data);*/
        $data = $model::select('customers.*','customer_status_history.followup_date')
            ->join('customer_status_history', 'customer_status_history.customer_id', '=', 'customers.id');


        if ($request->status != null) {
            $data = $data
                ->where('customer_status_history.status_id', '=', $request->status);
        }
        if ($request->mobile != null) {
            $data = $data
                ->where('customers.contact', '=', $request->mobile);
        }
        if ($request->from_date != null && $request->to_date == null) {
            $data = $data
                ->where('customer_status_history.followup_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $data = $data
                ->where('customer_status_history.followup_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $data = $data
                ->where('customer_status_history.followup_date', '>=', $request->from_date)
                ->where('customer_status_history.followup_date', '<=', $request->to_date);
        }
        if ($request->from_date == null || $request->to_date == null || ($request->from_date == null && $request->to_date == null)) {
            $data = $data
                ->where('customer_status_history.followup_date', '=', date('Y-m-d'));
        }
        $data = $data
           ->groupBy('customer_status_history.customer_id')
             ->orderBy('customer_status_history.id')
            ->paginate(20);
        return $data;

    }
    public function customerFollowupCount($model, $request, $count = null)
    {
        //for dashboard count
        if($count  == 1){
            $data = $model::select('customers.*', DB::raw('count(customer_id) as customer'))
                ->leftJoin('customer_status_history', 'customer_status_history.customer_id', '=', 'customers.id')
                ->whereDate('customer_status_history.followup_date', '=', date('Y-m-d'))
                ->groupBy('customer_status_history.customer_id')
                ->get();
            return $data;
        }
        $data = $model::select('customers.*','customer_status_history.followup_date')
            ->join('customer_status_history', 'customer_status_history.customer_id', '=', 'customers.id');


        if ($request->status != null) {
            $data = $data
                ->where('customer_status_history.status_id', '=', $request->status);
        }
        if ($request->mobile != null) {
            $data = $data
                ->where('customers.contact', '=', $request->mobile);
        }
        if ($request->from_date != null && $request->to_date == null) {
            $data = $data
                ->where('customer_status_history.followup_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $data = $data
                ->where('customer_status_history.followup_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $data = $data
                ->where('customer_status_history.followup_date', '>=', $request->from_date)
                ->where('customer_status_history.followup_date', '<=', $request->to_date);
        }
        if ($request->from_date == null || $request->to_date == null || ($request->from_date == null && $request->to_date == null)) {
            $data = $data
                ->where('customer_status_history.followup_date', '=', date('Y-m-d'));
        }
        $data = $data
            ->groupBy('customer_status_history.customer_id')
            ->orderBy('customer_status_history.id')
            ->count();
        return $data;

    }

}
