<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchDataRepository
{

    //fetch all data form table with pagination
    public function getAllSearchData($model, $order_column_name, $order, $paginateNo,$searchModule, $request)
    {
        $data = $model;
        if($searchModule == 'champaign')
        {
            $data = $this->champaignSearchData($model,$request);
        }
        if($searchModule == 'product')
        {
            $data = $this->productSearchData($model,$request);
        }
        if($searchModule == 'customer')
        {
            $data = $this->customerSearchData($model,$request);
        }
        if($searchModule == 'query')
        {
            $data = $this->customerQuerySearchData($model,$request);
        }
        if($searchModule == 'payment')
        {
            $data = $this->paymentSearchData($model,$request);
        }
        if($searchModule == 'app')
        {
            $data = $this->mobileAppSearchData($model,$request);
        }
        if($searchModule == 'notice')
        {
            $data = $this->noticeSearchData($model,$request);
        }
        $data = $data
            ->orderBy($order_column_name, $order)
            ->paginate($paginateNo);
        return $data;

    }
    //fetch all data form table with pagination
    public function getSearchDataCount($model,$searchModule, $request)
    {
        $data = $model;
        if($searchModule == 'champaign')
        {
            $data = $this->champaignSearchData($model,$request);
        }
        if($searchModule == 'product')
        {
            $data = $this->productSearchData($model,$request);
        }
        if($searchModule == 'customer')
        {
            $data = $this->customerSearchData($model,$request);
        }
        if($searchModule == 'query')
        {
            $data = $this->customerQuerySearchData($model,$request);
        }
        if($searchModule == 'payment')
        {
            $data = $this->paymentSearchData($model,$request);
        }
        if($searchModule == 'app')
        {
            $data = $this->mobileAppSearchData($model,$request);
        }
        $data = $data
            ->count();
        return $data;

    }

    /* champaign search data*/
    public function champaignSearchData($model,$request)
    {
        $data = $model;
        if($request->city_id !=null){
            $data = $data
                ->where('city_id', $request->city_id);
        }
        if ($request->from_date != null || $request->to_date != null) {
            $data = $this->searchDataByDate($model ,$request,'start_date','end_date');
        }
        return $data;
    }

    /* product search data*/
    public function productSearchData($model,$request)
    {
        $data = $model;
        if($request->campaign_id !=null){
            $data = $data
                ->where('campaign_id', $request->campaign_id);
        }
        if($request->product_category_id !=null){
            $data = $data
                ->where('product_category_id', $request->product_category_id);
        }
        return $data;
    }

    /* customer search data*/
    public function customerSearchData($model,$request)
    {
        $data = $model;
        if($request->customer_source_id !=null){
            $data = $data
                ->where('customer_source_id', $request->customer_source_id);
        }
        if($request->status !=null){
            $data = $data
                ->where('status', $request->status);
        }
        if($request->mobile !=null){
            $data = $data
                ->where('contact', $request->mobile);
        }
        if ($request->from_date != null || $request->to_date != null) {
            $data = $this->searchDataByDate($model ,$request,'created_date','created_date');
        }
        return $data;
    }
    /* customer query  search data*/
    public function customerQuerySearchData($model,$request)
    {
        $data = $model;
        if($request->source_id !=null){
            $data = $data
                ->where('source_of_query_id', $request->source_id);
        }
        return $data;
    }

    /* date search filter*/
    public  function searchDataByDate($model , $request ,$from_date_column ,$to_date_column)
    {
        $data = $model;
        if ($request->from_date != null && $request->to_date == null) {
            $data = $data
                ->where($from_date_column, '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $data = $data
                ->where($to_date_column, '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $data = $data
                ->where($from_date_column, '>=', $request->from_date)
                ->where($to_date_column, '<=', $request->to_date);
        }
        return $data;
    }
    /* champaign search data*/
    public function paymentSearchData($model,$request)
    {
        $data = $model;
        if($request->customer_id !=null){
            $data = $data
                ->where('customer_id', $request->customer_id);
        }
        if($request->product_id !=null){
            $data = $data
                ->where('product_id', $request->product_id);
        }
        if($request->payment_method_id !=null){
            $data = $data
                ->where('payment_method_id', $request->payment_method_id);
        }
        if ($request->from_date != null || $request->to_date != null) {
            $data = $this->searchDataByDate($model ,$request,'start_date','end_date');
        }
        return $data;
    }

    /* date search filter*/
    public  function getSellsData($model  ,$orderBy, $order_column_name,$paginateNo,$request=null ,$count=null)
    {
        $data = $model;
        $cfyStartDate = currentFY()->start_date;
        $cfyEndDate = currentFY()->end_date;
        if($request->office_id !=null){
            $data = $data
                ->where('office_id', $request->office_id);
        }
        if($request->product_id !=null){
            $data = $data
                ->where('product_id', $request->product_id);
        }
        if ($request->from_date != null && $request->to_date == null) {
            $data = $data
                ->where('purchase_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $data = $data
                ->where('purchase_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $data = $data
                ->where('purchase_date', '>=', $request->from_date)
                ->where('purchase_date', '<=', $request->to_date);
        }
        if($count !=null){
            $data = $data
                ->whereBetween('purchase_date', [$cfyStartDate, $cfyEndDate])
                ->orderBy($order_column_name,$orderBy)
                ->count();
            return $data;
        }
        $data = $data
            ->whereBetween('purchase_date', [$cfyStartDate, $cfyEndDate])
            ->orderBy($order_column_name,$orderBy)
            ->paginate($paginateNo);
        return $data;
    }

    /* champaign search data*/
    public function mobileAppSearchData($model,$request)
    {
        $data = $model;
        $authUser=Auth::user();

        if($authUser->user_type_id > 1){
            $data=$data->where('office_id',$authUser->office_id);
        }
        
        if($request->office_id !=null){
            $data = $data
                ->where('office_id', $request->office_id);
        }

        if($request->designation_id !=null){
            $data = $data
                ->where('designation_id', $request->designation_id);
        }

        if($request->name !=null){
            $data = $data
                ->where('name', $request->name);
        }

        if($request->mobile !=null){
            $data = $data
                ->where('mobile', $request->mobile);
        }

        return $data;
    }

    /* product search data*/
    public function noticeSearchData($model,$request)
    {
        $data = $model;
        if($request->all() !=null){
            $this->searchDataByDate($model,$request,'notice_date','notice_date');
        }
        return $data;
    }

}
