<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\Users\UserPasswordRequest;
use App\Http\Requests\Users\UserRequest;
use App\Models\Configurations\Designation;
use App\Models\Configurations\Office;
use App\Models\Roles\UserType;
use App\Repository\CommonRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{

    private $model;
    private $logMenu = 5;
    private $table = 'users';
    private $viewFile = 'backend.users.index';
    private $commonRepository;
    private $userType;
    //set file path variable
    private $filePath = 'uploads/users';
    //set file width
    private $fileWidth = 128;
    //set file height
    private $fileHeight = 128;
    private $resource;
    private $parentModel;
    private $order_column_name = 'id';
    private $orderBy = 'desc';
    private $paginateNo = 20;
    private $office;
    private $designation;


    public function __construct(UserType $parentModel, User $model, CommonRepository $commonRepository,
                                ResourceController $resource , Office $office , Designation $designation)
    {
        parent::__construct();

        $this->model = $model;
        $this->commonRepository = $commonRepository;
        $this->resource = $resource;
        $this->parentModel = $parentModel;
        $this->office = $office;
        $this->designation = $designation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['typeList'] = $this->commonRepository->all($this->parentModel, 'type_name','asc',true);
        
        $data['officeList'] = $this->commonRepository->all($this->office, 'office_name','asc');
        $data['designationList'] = $this->commonRepository->all($this->designation, 'name','asc');
        $data['results'] = $this->commonRepository->getAllData($this->model, $this->order_column_name,$this->orderBy,$this->paginateNo,true,'','',true);
        
        $data['page_title'] = 'User Management';
        $data['page_url'] = 'users';
        $data['page_route'] = 'users';
        return $this->resource->index($this->viewFile, $data);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        /* check all data from request form*/
        $data = $request->all();
        /* check request random password*/
        if($request->rand_password == 1){
            $password = rand_string(8);
            $data['password'] = bcrypt($password);
        }
        //check image form request
        if (!empty($request->file('image'))) {
            if (!empty($request->file('image'))) {
                $data['image'] = $this->resource->setFileUploadName($request->image, $request->full_name);
                $imageSuccess = true;
            }
        }
        $data['created_by'] = Auth::user()->id;
        $create = $this->resource->store($this->model, $data, $this->logMenu);
        if ($create) {
            //set image path
            if (isset($imageSuccess)) {
                $this->resource->setFileUploadPath($request->image, $data['image'], $this->filePath, $this->fileWidth, $this->fileHeight);
            }
            /* check user request email sent*/
            if($request->send_email == "1"){
                Mail::send('backend.email.add-user-email', ['fullName' => $request->full_name, 'userName' => $request->login_user_name, 'email' => $request->email, 'password' => $password], function ($m) use ($request) {
                    $m->to($request->email)->subject('User Credentials Information');
                });
            session()->flash('success', Lang::get('app.userCreateMessage'));
        }
        }
        return $create;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //check all data from request form
        $data = $request->all();
        $value = $this->commonRepository->findById($this->model, $id);
        if (!empty($request->file('image'))) {
            if (!empty($request->file('image'))) {
                $data['image'] = $this->resource->setFileUploadName($request->image, $request->full_name);
                $imageSuccess = true;
            }
        }
        /* check update password function */
        if($request->password !=null){
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $data['updated_by'] = Auth::user()->id;
        $update = $this->resource->update($this->model, $id, $data, $this->logMenu);
        if ($update) {
            if ($value->image != null) {
                $this->resource->deleteExistingFile($value->iamge, $this->filePath);
            }
            if (isset($imageSuccess)) {
                $this->resource->setFileUploadPath($request->image, $data['image'], $this->filePath, $this->fileWidth, $this->fileHeight);
            }
        }
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = $this->commonRepository->findById($this->model, $id);
        if ($value) {
            //delete existing image
            if ($value->image != null) {
                $this->resource->deleteExistingFile($value->iamge, $this->filePath);
            }
            $response = $this->resource->destroy($this->model, $id, $this->logMenu);
            return $response;
        }
    }


    //update status from user request
    public function status($id)
    {
        $response = $this->resource->status($this->table, $id, $this->logMenu);
        return $response;
    }

    //update user block status
    public function block_status($id)
    {
        $response = $this->resource->block_status($this->table, $id, $this->logMenu);
        return $response;
    }

    //check user profile link
    public function profile()
    {
        $user = Auth::user();
        $lastLogin = DB::table('login_logs')->where('user_id', $user->id)->orderBy('id', 'desc')->skip(1)->take(1)->value('created_at');
        return view('backend.users.profile', compact('user', 'lastLogin'));
    }

    //update user profile
    public function updateProfile(UserRequest $request)
    {
        $value = $this->commonRepository->findById($this->model, Auth::user()->id);

        if ($value) {
            $response = $this->resource->update($this->model, $value->id, $request->all(), $this->logMenu);
            session()->flash('success', 'Your profile successfully updated!');
            return $response;
        }
    }

    //update user password
    public function updatePassword(UserPasswordRequest $request)
    {
        if (Hash::check($request->input('old'), Auth::user()->password)) {
            $id = Auth::user()->id;
            $data = $this->model->find($id);
            if ($data) {
                $request['password'] = Hash::make($request->input('password'));
                $data->fill($request->all())->save();
                //create action log
                $this->resource->createLog($id, $this->logMenu, 9, '');
                session()->flash('success', 'Password was changed successfully!');
            }
        } else {

            session()->flash('error', 'Error Occurred!! Old password incorrect!');
        }
        return redirect()->back()->withInput();
    }

    //update profile pic
    public function profilePic(UploadFileRequest $request)
    {
        $response = $this->resource->updateUploadedFile($this->model, Auth::user()->id, $request->column_name, $request->update_file, Auth::user()->full_name, $this->filePath);
        return $response;
    }

}
