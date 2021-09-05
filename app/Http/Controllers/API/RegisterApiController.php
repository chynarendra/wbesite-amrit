<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\API\AppUser;
use App\Models\Configurations\CustomerStatus;
use App\Models\Configurations\Designation;
use App\Models\Configurations\Office;
use App\Repository\appUserRepository\AppUserInterface;
use App\Repository\office\OfficeInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterApiController extends Controller
{
    /**
     * @var OfficeInterface
     */
    private $officeInterface;
    /**
     * @var AppUserInterface
     */
    private $appUser;

    public function __construct(OfficeInterface $officeInterface,AppUserInterface $appUser)
    {
        $this->officeInterface = $officeInterface;
        $this->appUser = $appUser;
    }

    public function getOffice()
    {
        $responseBase = new ApiResponse();
        $data = DB::table('office')
            ->select('id','office_name')
            ->orderBy('office_name','asc')
            ->get();
        if ($data != null) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data = $data;
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Data Not Found";
            return response()->json($responseBase);

        }

    }
    public function getHeadOffice(){
        $responseBase = new ApiResponse();
        $headOffice=$this->officeInterface->getHeadOfficeDetail();

        if ($headOffice != null) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data = $headOffice;
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Data Not Found";
            return response()->json($responseBase);

        }

    }
    public function getDesignation()
    {
        $responseBase = new ApiResponse();
        $data = $data = DB::table('designations')
            ->select('id','name as designation_name')
            ->orderBy('name','asc')
            ->get();
        if ($data != null) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data = $data;
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Data Not Found";
            return response()->json($responseBase);

        }

    }

    public function getStatus()
    {
        $responseBase = new ApiResponse();
        $data =CustomerStatus::all();
        if ($data != null) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data = $data;
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Data Not Found";
            return response()->json($responseBase);

        }

    }

    public function register(Request $request)
    {
        $responseBase = new ApiResponse();
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'address' => 'required',
            'mobile' => 'required|unique:app_users,mobile',
            'email' => 'required|unique:app_users,email',
            'office_id' => 'required',
            'designation_id' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "status_code" => 422, "message" => $validator->errors()->all()], 422);
        }
        $row = [
            'full_name' => $request->full_name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'office_id' => (int)$request->office_id,
            'designation_id' => (int)$request->designation_id,
            'password' => bcrypt($request->password),
            'status' => '0',
            'register_date' => Carbon::now()
        ];
        $user = AppUser::create($row);
        if ($user) {
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->message = "Register Successfully. you will get an email after approve your record!";
            return response()->json($responseBase);
        } else {
            $responseBase->status_code = 404;
            $responseBase->message = "Something is wrong";
            return response()->json($responseBase,404);
        }
    }

    public function changePassword(Request $request){

        $responseBase = new ApiResponse();
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "status_code" => 422, "message" => $validator->errors()->all()], 422);
        }
        $userByEmail =$this->appUser->getUserByEmail($request->username);
        $userByPhone =$this->appUser->getUserByPhoneNo($request->username);
        $user=null;

        if($userByEmail){
            $user=$userByEmail;
        }elseif ($userByPhone){
            $user=$userByPhone;
        }

        if($user){
            $user->password=bcrypt($request->password);
            $userUpdated =$user->save();
            if ($userUpdated) {
                $responseBase->success = true;
                $responseBase->status_code = 200;
                $responseBase->message = "Password changed successfully";
                return response()->json($responseBase,200);
            }
        }
        $responseBase->status_code = 404;
        $responseBase->message = "Your email/phone no is not found";
        return response()->json($responseBase,404);
    }

    public function updateUser(Request $request,$id){
        $responseBase = new ApiResponse();
        $user=$this->appUser->findUserById($id);
        if($user){
            $update=$user->fill($request->all())->save();
            $responseBase->success = true;
            $responseBase->status_code = 200;
            $responseBase->data=$user;
            return response()->json($responseBase,200);
        }else{
            $responseBase->status_code = 404;
            $responseBase->message = "Your email/phone no is not found";
            return response()->json($responseBase,404);
        }

    }
}
