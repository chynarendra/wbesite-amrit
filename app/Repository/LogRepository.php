<?php

namespace App\Repository;

use App\Models\Logs\ActionLogs;
use App\Models\Logs\LoginFails;
use App\Models\Logs\LoginLogs;
use Illuminate\Support\Facades\Auth;

class LogRepository
{

    private $loginLogs;
    private $loginFails;
    private $actionLog;

    public function __construct(LoginLogs $loginLogs,
                                LoginFails $loginFails,
                                ActionLogs $actionLog)
    {
        $this->loginLogs = $loginLogs;
        $this->loginFails = $loginFails;
        $this->actionLog = $actionLog;
    }

    public function getAllLoginLog($request)
    {
        $result = $this->loginLogs
            ->leftJoin('users', 'login_logs.user_id', '=', 'users.id');

        if ($request->user_id != null && $request->from_date == null && $request->to_date == null) {

            $result = $result->where('user_id', $request->user_id);

        }
        if ($request->user_id) {

            $result = $result->where('user_id', $request->user_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('log_in_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('log_in_date', '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('log_in_date', '>=', $request->from_date)
                ->where('log_in_date', '<=', $request->to_date);
        }
        /* check super admin */
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
                $result = $result
                    ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }
        $result = $result
            ->select('login_logs.*')
            ->orderBy('login_logs.id', 'desc')
            ->paginate(20);
        return $result;
    }
    public function getTotalLoginLog($request)
    {
        $result = $this->loginLogs
            ->leftJoin('users', 'login_logs.user_id', '=', 'users.id');

        if ($request->user_id != null && $request->from_date == null && $request->to_date == null) {

            $result = $result->where('user_id', $request->user_id);

        }
        if ($request->user_id) {

            $result = $result->where('user_id', $request->user_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('log_in_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('log_in_date', '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('log_in_date', '>=', $request->from_date)
                ->where('log_in_date', '<=', $request->to_date);
        }
        /* check super admin */
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
                $result = $result
                    ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }

        $result = $result
            ->count();
        return $result;
    }

    public function getAllLoginFails($request)
    {

        $result = $this->loginFails
            ->leftJoin('users', 'login_fails.user_id', '=', 'users.id');

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('log_fails_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('log_fails_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('log_fails_date', '>=', $request->from_date)
                ->where('log_fails_date', '<=', $request->to_date);
        }
        /* check super admin */
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
                $result = $result
                    ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }
        $result = $result
            ->orderBy('login_fails.id', 'desc')
            ->paginate(20);
        return $result;
    }
    public function getTotalLoginFails($request)
    {

        $result = $this->loginFails
            ->leftJoin('users', 'login_fails.user_id', '=', 'users.id');

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('log_fails_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('log_fails_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('log_fails_date', '>=', $request->from_date)
                ->where('log_fails_date', '<=', $request->to_date);
        }
        /* check super admin */
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
                $result = $result
                    ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }
        $result = $result
            ->count();
        return $result;
    }

    public function getAllActionLogs($request)
    {
        $result = $this->actionLog
            ->leftJoin('users', 'action_logs.action_user_id', '=', 'users.id');

        if ($request->module_name) {

            $result = $result->where('action_module', $request->module_name);

        }
        if ($request->action_name) {

            $result = $result->where('action_name', $request->action_name);

        }

        if ($request->user_id) {

            $result = $result->where('action_user_id', $request->user_id);

        }
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('action_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('action_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('action_date', '>=', $request->from_date)
                ->where('action_date', '<=', $request->to_date);
        }
        /* check super admin */
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
            $result = $result
                ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }

        $result = $result
            ->select('action_logs.*')
            ->orderBy('action_logs.id', 'desc')
            ->whereNotIn('action_name', [9,10])
            ->paginate(20);
        return $result;
    }
    public function getTotalActionLogs($request)
    {
        $result = $this->actionLog
            ->leftJoin('users', 'action_logs.action_user_id', '=', 'users.id');

        if ($request->module_name) {

            $result = $result->where('action_module', $request->module_name);

        }
        if ($request->action_name) {

            $result = $result->where('action_name', $request->action_name);

        }

        if ($request->user_id) {

            $result = $result->where('action_user_id', $request->user_id);

        }
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('action_date', '>=', $request->from_date);
        }
        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('action_date', '<=', $request->to_date);
        }
        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('action_date', '>=', $request->from_date)
                ->where('action_date', '<=', $request->to_date);
        }
        if(Auth::user()->user_type_id >1){
            if(Auth::user()->user_type_id == 2)
                $result = $result
                    ->whereNotIn('users.user_type_id', [1]);
            else
                $result = $result
                    ->whereNotIn('users.user_type_id', [1])
                    ->where('users.id', Auth::user()->id);
        }

        $result = $result
            ->whereNotIn('action_name', [9,10])
            ->count();
        return $result;
    }
    public function findByLogFailsId($id)
    {
        $data = $this->loginFails->find($id);
        return $data;
    }
}
