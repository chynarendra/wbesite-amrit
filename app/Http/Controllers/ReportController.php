<?php

namespace App\Http\Controllers;

use App\Exports\GeneralDispatchExport;
use App\Exports\RegistrationGeneralExport;
use App\Models\Models\DispatchMethod;
use App\Repository\DispatchGeneral\DispatchGeneralInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    /**
     * @var DispatchGeneralInterface
     */
    private $dispatchGeneral;

    public function __construct(DispatchGeneralInterface $dispatchGeneral)
    {
        $this->dispatchGeneral = $dispatchGeneral;
    }

    public function generalDispatch(Request $request){
        $dispatchGenerals=$this->dispatchGeneral->allDispatchGenerals($request);
        $dispatchMethods=DispatchMethod::all();
        if($request->click=='excel'){
            return Excel::download(new GeneralDispatchExport($dispatchGenerals,$request), 'dispatchGeneral.xlsx');
        }
        return view('Report.dispatchGeneral',compact('dispatchGenerals','dispatchMethods','request'));
    }

    public function generalRegistration(Request $request){
        $registrationGenerals=$this->dispatchGeneral->allRegistrationGenerals($request);
        if($request->click=='excel'){
            return Excel::download(new RegistrationGeneralExport($registrationGenerals,$request), 'registrationGeneral.xlsx');
        }
        return view('Report.registrationGeneral',compact('registrationGenerals','request'));
    }
}
