<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeApiController extends Controller
{
    public function getNoticeList()
    {
        $responseBase = new ApiResponse();
        $data = $data = DB::table('notices')
            ->select('id','notice_title','notice_description','notice_date')
          ->where('notice_status','1')
            ->orderBy('notice_date','desc')
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
    public function getNoticeDetails($id)
    {
        $responseBase = new ApiResponse();
        $data = Notice::where('id',$id)->select('id','notice_title','notice_description','notice_date')->first();
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
}
