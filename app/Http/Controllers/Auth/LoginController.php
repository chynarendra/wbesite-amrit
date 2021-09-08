<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Logs\LoginFails;
use App\Models\Logs\LoginLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $messages = [
            'identity.required' => 'Email or username cannot be empty',
            'identity.min' => 'User name must me 3 characters long.',
            'password.required' => 'Password cannot be empty',
            'password.min' => 'Password must me 6 characters long',
            'captcha.required' => 'Captcha cannot be empty',
        ];
        //check captcha validation
        if(systemSetting()->login_captcha_required == 1)
            $request->validate([
                'identity' => 'required|min:3|string',
                'password' => 'required|min:3|string',
                'captcha' => 'required|captcha',
            ], $messages);
        else
            $request->validate([
                'identity' => 'required|min:3|string',
                'password' => 'required|min:3|string',
            ], $messages);

        //default validation check
        // $this->validateLogin($request);
        //login failed count
        $user = User::where($this->username(), $request->{$this->username()})->first();
        if (isset($user)) {
            $loginFailed = getUserLoginFailed($user->id);
            if (systemSetting()->login_attempt_required == 1 && $loginFailed >= getLoginAttempt()->login_attempt_limit) {
                $errors = [$this->username() => trans('auth.authBlock')];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);

            }
            // check user  status is not 1. If so, override the default error message.
            if($user->status != 1){
                $errors = [$this->username() => trans('auth.authInactive')];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }

        }else{
            $loginFailed = getIpLoginFailed();
            if ($loginFailed >= getLoginAttempt()->login_attempt_limit) {
                $errors = [$this->username() => trans('auth.authUnknown')];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {
        $identity = request()->get('identity');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'login_user_name';
        request()->merge([$fieldName => $identity]);

        return $fieldName;
    }
    /* Check user status (active or not) */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['status' => '1']);
    }

    /* insert value login log table  */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $now = Carbon::now();
        $ip = \Request::ip();
        $agent = device_info();
        LoginLogs::create(['user_id' => Auth::user()->id, 'log_in_ip' => $ip, 'log_in_device' => $agent, 'log_in_date' => $now]);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /* insert value login fails table  */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();
        //set default variable for login fails table
        $user_id = null;
        $loginFailCount = null;
        $now = Carbon::now();
        $ip = \Request::ip();
        $agent = device_info();
        //check user exist
        if (isset($user)) {
            $user_id = $user->id;
            $loginFailed = getUserLoginFailed($user->id);
            $loginFailCount = $loginFailed + 1;
        }else{
            $loginFailed = getIpLoginFailed();
            $loginFailCount = $loginFailed + 1;
        }
        //insert value in login fails table
        LoginFails::create(['user_name' => $request->get('identity'), 'fail_password' => $request->get('password'), 'log_in_ip' => $ip, 'log_in_device' => $agent,
            'log_fails_date' => $now, 'user_id' => $user_id, 'login_fail_count' => $loginFailCount]);

        //set user block status
        if (isset($user)) {
            if(systemSetting()->login_attempt_required == 1){
                $loginFailedCount =  getUserLoginFailed($user->id);
                $daysTotalAttempt = getLoginAttempt()->login_attempt_limit;
                $failedAttempt = $daysTotalAttempt - $loginFailedCount;
                //update user  block status
                if ($loginFailedCount == getLoginAttempt()->login_attempt_limit) {
                    User::where('id', $user->id)->update(['block_status' => '1']);
                }
                //set login fail attempt message
                if($failedAttempt > 0){
                    $errors = [$this->username() => trans('Invalid User Name or Password. You are left with' .' '. $failedAttempt .'  '. 'Attempts')];
                }else{
                    $errors = [$this->username() => trans('Invalid User Name or Password. You are last Attempt')];
                }
            }else{
                $errors = [$this->username() => trans('Invalid User Name or Password.')];
            }

        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /* redirect log out route  */
    public function logout(Request $request)
    {
        Auth::logout();
        session()->flash('success', 'You have been successfully logged out!');
        return redirect('/login');
    }

    /* load captcha   */
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

}