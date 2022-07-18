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
            $page_title=isset($data['page_title'])?$data['page_title']:'';
            $page_url=isset($data['page_url'])?$data['page_url']:'';
            $page_slide_url=isset($data['page_slide_url'])?$data['page_slide_url']:'';
            $page_route=isset($data['page_route'])?$data['page_route']:'';
            $results=isset($data['results'])?$data['results']:'';
            $result=isset($data['result'])?$data['result']:'';
            $request=isset($data['request'])?$data['request']:'';
            $officeList=isset($data['officeList'])?$data['officeList']:'';
            $districtList=isset($data['districtList'])?$data['districtList']:'';
            $pages=isset($data['pages'])?$data['pages']:'';
            $modules=isset($data['modules'])?$data['modules']:'';
            $parentMenus=isset($data['parent_menus'])?$data['parent_menus']:'';
            $menuTypes=isset($data['menu_type'])?$data['menu_type']:'';
            $typeList =isset($data['typeList'])?$data['typeList']:'';
            $menus =isset($data['menus'])?$data['menus']:'';
            $menuRepo =isset($data['menuRepo'])?$data['menuRepo']:'';
            $request =isset($data['request'])?$data['request']:'';
            $users=isset($data['users '])?$data['users ']:'';
            $moduleNames =isset($data['moduleNames'])?$data['moduleNames']:'';
            $actionNames =isset($data['actionNames'])?$data['actionNames']:'';
            $file_upload_url  =isset($data['file_upload_url'])?$data['file_upload_url']:'';
            $status_url =isset($data['status_url '])?$data['status_url ']:'';

            if(isset($data['users'])){
                $users=$data['users'];
            }else{
                $users='';
            }

            return view($view, compact('data','pages','parentMenus','moduleNames',
            'actionNames','users','menuTypes','menus','menuRepo','request','typeList',
            'modules','result','page_title','page_url','page_slide_url','page_route',
            'officeList','districtList','request','results','file_upload_url','status_url'));

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
                $pages=isset($data['pages'])?$data['pages']:'';
                $modules=isset($data['modules'])?$data['modules']:'';
                $parentMenus=isset($data['parent_menus'])?$data['parent_menus']:'';
                $menuTypes=isset($data['menu_type'])?$data['menu_type']:'';

                return view($view, compact('data','value','page_title','page_url','page_route','pages','modules','parentMenus','menuTypes'));
            } else {
                session()->flash('error', Lang::get('app.dataNotFoundMessage'));
            }
            return back();

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
            return back();
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
                $update=DB::table($table)->where('id',$id)->update(['status'=>'1']);
                $this->createLog($value->id, $logMenu, '5');
                session()->flash('success', Lang::get('app.statusActiveMessage'));
            } elseif (isset($value->status) && $value->status == '1') {
                DB::table($table)->where('id',$id)->update(['status'=> '0']);
                $this->createLog($value->id, $logMenu, '6');
                session()->flash('success', Lang::get('app.statusInactiveMessage'));
            }elseif (isset($value->status) && $value->status == 'active') {
                DB::table($table)->where('id',$id)->update(['status'=> 'inactive']);
                $this->createLog($value->id, $logMenu, '6');
                session()->flash('success', Lang::get('app.statusInactiveMessage'));
            }elseif (isset($value->status) && $value->status == 'inactive') {
                DB::table($table)->where('id',$id)->update(['status'=> 'active']);
                $this->createLog($value->id, $logMenu, '6');
                session()->flash('success', Lang::get('app.statusInactiveMessage'));
            }
            else{
                session()->flash('error', Lang::get('app.errorStatusMessage'));
            }
            return back();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            session()->flash('error', $message);
            return back();
        }

    }

    public function slide($table, $id, $logMenu)
    {
        try {
            $id = (int)$id;
            $value = DB::table($table)->find($id);
            if (isset($value->is_slide) && $value->is_slide == 'no') {
                $update=DB::table($table)->where('id',$id)->update(['is_slide'=>'yes']);
                $this->createLog($value->id, $logMenu, '5');
                session()->flash('success', Lang::get('app.statusActiveMessage'));
            } elseif (isset($value->is_slide) && $value->is_slide == 'yes') {
                DB::table($table)->where('id',$id)->update(['is_slide'=> 'no']);
                $this->createLog($value->id, $logMenu, '6');
                session()->flash('success', Lang::get('app.statusInactiveMessage'));
            }
            else{
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
