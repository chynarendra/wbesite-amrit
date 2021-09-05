<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
            return view('404');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        if(systemSetting()->register_captcha_required == 1 && systemSetting()->strong_password == 0)
        return Validator::make($data, [
            'name' => 'required|regex:/[A-Za-z. -]/|min:3|max:100',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required',
            'password_confirmation' =>'required',
            'captcha' =>'required|captcha'
        ]);
        elseif(systemSetting()->strong_password == 1 && systemSetting()->register_captcha_required == 0)
            return Validator::make($data, [
                'name' => 'required|regex:/[A-Za-z. -]/|min:3|max:100',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                'password' => 'required|string|min:8|confirmed|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' =>'required',
            ]);
        elseif(systemSetting()->register_captcha_required == 1 && systemSetting()->strong_password == 1)
            return Validator::make($data, [
                'name' => 'required|regex:/[A-Za-z. -]/|min:3|max:100',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                'password' => 'required|string|min:8|confirmed|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' =>'required',
                'captcha' =>'required|captcha'
            ]);
        else
            return Validator::make($data, [
                'name' => 'required|regex:/[A-Za-z. -]/|min:3|max:100',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
                'password' => 'required',
                'password_confirmation' =>'required',
            ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'full_name' => $data['name'],
            'email' => $data['email'],
            'login_user_name' => $data['email'],
            'user_type_id' => 2 ,
            'password' => Hash::make($data['password']),
        ]);
    }
}
