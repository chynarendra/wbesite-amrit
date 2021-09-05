<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use App\Models\API\AppUser;
use App\Repository\appUserRepository\AppUserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    /**
     * @var AppUserInterface
     */
    private $appUser;

    public function __construct(AppUserInterface $appUser)
    {
        $this->appUser = $appUser;
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
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

        if($user && Hash::check($request->password,$user->password)){
            if($user){
                $responsedata = json_decode($user, true);
                return response()->json($responsedata);
            }
        }else{
            return response()->json(['status' => false, "status_code" => 404, 'message' => "Invalid Credentials"], 404);
        }

//        $request['email']=$request->username;
//        $credentials = request(['email', 'password']);
//        if(!Auth::attempt($credentials)) {
//            return response()->json(['status' => false, "status_code" => 404, 'message' => "Invalid Credentials"], 404);
//        }
//
//        $user = AppUser::where($this->username(), $request->{$this->username()})->first();
//        if($user){
//            $responsedata = json_decode($user, true);
//            return response()->json($responsedata);
//        }
    }
    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        $identity = request()->get('username');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        request()->merge([$fieldName => $identity]);

        return $fieldName;
    }
}
