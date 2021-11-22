<?php

namespace App\Http\Controllers;

use App\Models\Logs\ActionLogs;
use App\Models\MonthLeaves;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResourceController extends Controller
{

    /* display  resources value */
    public function index($view, $data)
    {
        if($view !=null && $data !=null){
            $page_title=$data['page_title'];

            if(isset($data['users'])){
                $users=$data['users'];
            }else{
                $users='';
            }

            if(isset($data['customer'])){
                $customer=$data['customer'];
            }else{
                $customer='';
            }

            if(isset($data['purchased_products'])){
                $purchased_products=$data['purchased_products'];
            }else{
                $purchased_products='';
            }

            if(isset($data['customerId'])){
                $customerId=$data['customerId'];
            }else{
                $customerId='';
            }
            if(isset($data['results'])){
                $results=$data['results'];
            }else{
                $results='';
            }

            if(isset($data['menus'])){
                $menus=$data['menus'];
            }else{
                $menus=[];
            }

            if(isset($data['menuRepo'])){
                $menuRepo=$data['menuRepo'];
            }else{
                $menuRepo=[];
            }

            if(isset($data['typeList'])){
                $typeList=$data['typeList'];
            }else{
                $typeList=[];
            }

            if(isset($data['page_route'])){
                $page_route=$data['page_route'];
            }else{
                $page_route='';
            }

            if(isset($data['page_url'])){
                $page_url=$data['page_url'];
            }else{
                $page_url='';
            }

            if(isset($data['request'])){
                $request=$data['request'];
            }else{
                $request=[];
            }
        
            if(isset($data['totalResult'])){
                $totalResult=$data['totalResult'];
            }else{
                $totalResult=[];
            }

            if(isset($data['cityList'])){
                $cityList=$data['cityList'];
            }else{
                $cityList=[];
            }

            if(isset($data['productCategoryList'])){
                $productCategoryList=$data['productCategoryList'];
            }else{
                $productCategoryList=[];
            }

            if(isset($data['sourceList'])){
                $sourceList=$data['sourceList'];
            }else{
                $sourceList=[];
            }

            if(isset($data['customerList'])){
                $customerList=$data['customerList'];
            }else{
                $customerList=[];
            }

            if(isset($data['campaignList'])){
                $campaignList=$data['campaignList'];
            }else{
                $campaignList=[];
            }

            if(isset($data['productList'])){
                $productList=$data['productList'];
            }else{
                $productList=[];
            }

            if(isset($data['paymentMethodList'])){
                $paymentMethodList=$data['paymentMethodList'];
            }else{
                $paymentMethodList=[];
            }

            if(isset($data['moduleNames'])){
                $moduleNames=$data['moduleNames'];
            }else{
                $moduleNames='';
            }

            if(isset($data['actionNames'])){
                $actionNames=$data['actionNames'];
            }else{
                $actionNames='';
            }

            if(isset($data['totalLogs'])){
                $totalLogs=$data['totalLogs'];
            }else{
                $totalLogs='';
            }

            if(isset($data['districtList'])){
                $districtList=$data['districtList'];
            }else{
                $districtList=[];
            }

            if(isset($data['officeList'])){
                $officeList=$data['officeList'];
            }else{
                $officeList=[];
            }

            if(isset($data['result'])){
                $result=$data['result'];
            }else{
                $result=[];
            }

            if(isset($data['file_upload_url'])){
                $file_upload_url=$data['file_upload_url'];
            }else{
                $file_upload_url=[];
            }

            if(isset($data['status_url'])){
                $status_url=$data['status_url'];
            }else{
                $status_url=[];
            }

            if(isset($data['fieldVisitDetail'])){
                $fieldVisitDetail=$data['fieldVisitDetail'];
            }else{
                $fieldVisitDetail='';
            }

            return view($view, compact('data','page_title','page_url','page_route','request',
            'results','cityList','productCategoryList','sourceList','totalResult','customerList',
            'productList','paymentMethodList','typeList','menus','menuRepo','users','moduleNames',
            'actionNames','totalLogs','districtList','officeList','result','file_upload_url','status_url',
            'fieldVisitDetail','customer','customerId','purchased_products','campaignList'));

        }else{
            session()->flash('error', Lang::get('app.viewFileNotFound'));
            return back();
        }

    }

   /* open create  form from user request*/
    public function create($view, $data = null)
    {
        if($view !=null && $data !=null){
            $page_title=$data['page_title'];
            $page_url=$data['page_url'];
            $page_route=$data['page_route'];
            if(isset($data['cityList'])){
                $cityList=$data['cityList'];
            }else{
                $cityList=[];
            }

            if(isset($data['productCategoryList'])){
                $productCategoryList=$data['productCategoryList'];
            }else{
                $productCategoryList=[];
            }

            if(isset($data['sourceList'])){
                $sourceList=$data['sourceList'];
            }else{
                $sourceList=[];
            }

            if(isset($data['customerList'])){
                $customerList=$data['customerList'];
            }else{
                $customerList=[];
            }

            if(isset($data['campaignList'])){
                $campaignList=$data['campaignList'];
            }else{
                $campaignList=[];
            }

            if(isset($data['customerList'])){
                $customerList=$data['customerList'];
            }else{
                $customerList=[];
            }

            if(isset($data['productList'])){
                $productList=$data['productList'];
            }else{
                $productList=[];
            }

            if(isset($data['paymentMethodList'])){
                $paymentMethodList=$data['paymentMethodList'];
            }else{
                $paymentMethodList=[];
            }

            if(isset($data['appUserDetail'])){
                $appUserDetail=$data['appUserDetail'];
            }else{
                $appUserDetail='';
            }
            

            return view($view, compact('data','page_title','page_url','page_route','cityList',
            'productCategoryList','sourceList','campaignList','campaignList','customerList',
            'productList','paymentMethodList','appUserDetail'));
        }else{
            session()->flash('error', Lang::get('app.viewFileNotFound'));
            return back();
        }

    }

   /* insert new form user request */
    public function store($model, $data, $logMenu = null)
    {
        try {
            if (isset($data))

                $create = $model->create($data);
            if ($create)
                //create action log
                $this->createLog($create->id, $logMenu, 1, '');
                session()->flash('success', Lang::get('app.insertMessage'));
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

   /* view existing data from user request */
    public function show($model, $id, $data, $view)
    {
        try {
            $id = (int)$id;
            $value = $model->find($id);
            if ($value) {

                $page_title=$data['page_title'];
                $page_url=$data['page_url'];
                $page_route=$data['page_route'];

                if(isset($data['details'])){
                    $details=$data['details'];
                }else{
                    $details='';
                }

                if(isset($data['status_history'])){
                    $status_history=$data['status_history'];
                }else{
                    $status_history='';
                }

                if(isset($data['payments'])){
                    $payments=$data['payments'];
                }else{
                    $payments='';
                }

                if(isset($data['purchased_products'])){
                    $purchased_products=$data['purchased_products'];
                }else{
                    $purchased_products='';
                }
    
                if(isset($data['appUserDetail'])){
                    $appUserDetail=$data['appUserDetail'];
                }else{
                    $appUserDetail='';
                }
    
                if(isset($data['fieldVisitDetail'])){
                    $fieldVisitDetail=$data['fieldVisitDetail'];
                }else{
                    $fieldVisitDetail='';
                }

                return view($view, compact('data','details','appUserDetail',
                'fieldVisitDetail','page_title','page_url','page_route','status_history',
                'purchased_products','payments'));
            } else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            return back();

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

  /* edit form open from user request */
    public function edit($model, $id, $data, $view)
    {
        try {
            $id = (int)$id;
            $value = $model->find($id);
            if ($value) {
                
                return view($view, $data);
            } else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            return back();

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /* update existing data value form user request */
    public function update($model, $id, $data, $logMenu = null)
    {

        try {
            $value = $model->find($id);
            if ($value) {
                if (isset($data))
                    $value->fill($data)->save();
                else
                    session()->flash('error', Lang::get('app.errorUpdateMessage'));
            }else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            $this->createLog($value->id, $logMenu, 2, '');
            session()->flash('success', Lang::get('app.updateMessage'));
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

   /* delete existing value form user request  */
    public function destroy($model, $id, $logMenu = null, $file = null, $filePath = null)
    {
        try {
            $value = $model->find($id);
            if ($value) {
                $this->createLog($value->id, $logMenu, '4');
                $value->delete();
                @unlink(storage_path() . '/app/public/' . $filePath . '/' . $file);
            }else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            session()->flash('success', Lang::get('app.deleteMessage'));
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    public function destroyLeave($model, $id, $logMenu = null, $file = null, $filePath = null)
    {
        try {
            $value = $model->find($id);
            if ($value) {
                $this->createLog($value->id, $logMenu, '4');
                $leaveDates=MonthLeaves::where('app_user_leave_id',$id)->get();
                if(sizeof($leaveDates) > 0){
                    foreach ($leaveDates as $date){
                        $date->delete();
                    }
                }
                $value->delete();
                @unlink(storage_path() . '/app/public/' . $filePath . '/' . $file);
            }else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            session()->flash('success', Lang::get('app.deleteMessage'));
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

   /* check foreign key form child table */
    public function checkForeignKey($table, $id, $foreignId)
    {
        $value = DB::table($table)->where($foreignId, $id)->select('id')->count();
        return $value;
    }

   /* update  status from user request */
    public function status($table, $id, $logMenu)
    {
        try {
            $id = (int)$id;
            $value = DB::table($table)->find($id);
            if (isset($value->status) && $value->status == '0') {
                DB::table($table)->where('id',$id)->update(['status'=>'1']);
                $this->createLog($value->id, $logMenu, '5');
                session()->flash('success', Lang::get('app.statusActiveMessage'));
            } elseif (isset($value->status) && $value->status == '1') {
                DB::table($table)->where('id',$id)->update(['status'=> '0']);
                $this->createLog($value->id, $logMenu, '6');
                session()->flash('success', Lang::get('app.statusInactiveMessage'));
            }else{
                session()->flash('error', Lang::get('app.errorStatusMessage'));
            }
            return back();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }

    }

    /* delete existing file  form path  */
    public function deleteExistingFile($fileName, $filePath)
    {
        @unlink(storage_path() . '/app/public/' . $filePath . '/' . $fileName);
    }

    /* set upload file name */
    public function setFileUploadName($file, $fileName)
    {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = $fileName . time() . '.' . strtolower($fileExtension);
            return $fileName;
    }

    /* set upload file path library */
    public function setFileUploadPath($file, $fileName, $filePth, $fileWidth = null, $fileHeight = null)
    {
        Storage::putFileAs('public/' . $filePth, $file, $fileName);
        if($fileWidth !=null && $fileHeight !=null )
        Image::make(storage_path() . '/app/public/' . $filePth . '/' . $fileName)->resize($fileWidth, $fileHeight)->save();
        else
        Image::make(storage_path() . '/app/public/' . $filePth . '/' . $fileName)->save();
    }

    /*  insert action from user action activity */
    public function createLog($actionId, $moduleName, $logType, $actionUrl = null)
    {
        $actionDate = Carbon::now();
        $actionIp = \Request::ip();
        $actionDevice = device_info();
        $value['action_ip'] = $actionIp;
        $value['action_id'] = $actionId;
        $value['action_device'] = $actionDevice;
        $value['action_module'] = $moduleName;
        $value['action_date'] = $actionDate;
        $value['action_user_id'] = Auth::user()->id;
        $value['action_name'] = $logType;
        $value['action_url'] = $actionUrl;
        return DB::table('action_logs')
            ->insert($value);
    }

    /* unblock user login attempt */
    public function block_status($table, $id, $logMenu)
    {
        try {
            $id = (int)$id;
            $value = DB::table($table)->find($id);
            if (isset($value->block_status) && $value->block_status == '1') {
                //update  user block status
                DB::table($table)->where('id',$id)->update(['block_status'=>'0']);
                //update log fails table
                DB::table('login_fails')->where('user_id',$id)->update(['login_fail_count'=> NULL]);
                //create action log
                $this->createLog($value->id, $logMenu, '7');
                session()->flash('success', Lang::get('app.unBlockStatusMessage'));
            }else{
                session()->flash('error', Lang::get('app.errorStatusMessage'));
            }
            return back();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }

    }
    /* update existing file only   */
    public function updateUploadedFile($model , $id, $column_name , $file ,$fileTitle ,$filePath , $fileWidth = null , $fileHeight =null)
    {
        try {
            $id = (int)$id;
            $value = $model->find($id);
            if($value){
                    if ($column_name != null && $fileTitle != null && $file !=null) {
                        $fileName = $this->setFileUploadName($file, $fileTitle);
                        $imageSuccess = true;
                        if ($value->$column_name != null) {
                            $this->deleteExistingFile($value->$column_name,$filePath);
                        }
                        $update = $model::where('id',$id)->update([$column_name=>$fileName]);
                        if($update){
                            if (isset($imageSuccess)) {
                                $this->setFileUploadPath($file, $fileName, $filePath, $fileWidth, $fileHeight);
                            }
                            session()->flash('success', Lang::get('app.imageUploadSuccess'));
                        }
                    }else{
                    session()->flash('error', Lang::get('app.imageUploadFailed'));
                }
                return back();
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }
    }

    /* delete existing uploaded file from path & database table */
    public function deleteUploadedFile($model, $id, $column,  $filePath)
    {
        $id = (int)$id;
        try {
            $value = $model->find($id);
            if ($value) {
                    $this->deleteExistingFile($value->$column, $filePath);
                    $model::where('id', $id)->update([$column => null]);
                    session()->flash('success', Lang::get('app.imageDeletedSuccess'));
            }else{
                session()->flash('error', Lang::get('app.imageDeletedFailed'));
            }
            return back();

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }

    }
}
