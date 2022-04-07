<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralInformationValidation;
use App\Models\Models\RegistrationGeneral;
use App\Repository\fiscalYear\FiscalYearInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class GeneralInformationController extends BaseController
{
    //
    /**
     * @var RegistrationGeneral
     */
    private $registrationGeneral;
    /**
     * @var FiscalYearInterface
     */
    private $fiscalYear;

    public function __construct(RegistrationGeneral $registrationGeneral,FiscalYearInterface $fiscalYear){
        $this->registrationGeneral = $registrationGeneral;
        $this->fiscalYear = $fiscalYear;
    }

    public function index(){
        $infos=RegistrationGeneral::paginate(100);
        return view('GeneralInfo.index',compact('infos'));
    }

    public function create(){
        return view('GeneralInfo.create');
    }

    public function show($id){
        $data=RegistrationGeneral::find($id);
        if($data){
            return view('GeneralInfo.show',compact('data'));
        }else{
            session()->flash('error','Data not found');
            return back();
        }
    }

    public function store(GeneralInformationValidation $request){
        try {
            $fiscalYear=$this->fiscalYear->getFiscalYearByDate($request->REG_DT_ENG);
            $data=$request->all();
            $data['FISCAL_YR']=$fiscalYear->code;
            $data['ENTERED_BY']=Auth::user()->full_name;
            $data['ENTERED_DT_ENG']=date('Y-m-d');
            $data['ENTERED_DT_NEP']=date('Y-m-d');
            $create=RegistrationGeneral::create($data);
            session()->flash('success', Lang::get('app.insertMessage'));
            return redirect(url('general/info'));
        } catch (\Exception $e) {
            $e->getMessage();
            dd($e);
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    public function edit($id){
        $data=RegistrationGeneral::find($id);
        if($data){
            return view('GeneralInfo.edit',compact('data'));
        }else{
            session()->flash('error','Data not found');
            return back();
        }
    }

    public function update(GeneralInformationValidation $request,$id){
        try {
            $data=$request->all();
            $registrationGeneral=RegistrationGeneral::find($id);
            if($registrationGeneral){
                $updated=$registrationGeneral->fill($data)->save($data);
                session()->flash('success', Lang::get('app.insertMessage'));
                return redirect(url('general/info'));
            }
            session()->flash('error', 'Data not found');
            return back();
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    public function destroy($id){
        $registrationGeneral=RegistrationGeneral::find($id);
        if($registrationGeneral){
            $registrationGeneral->delete();
            session()->flash('success', 'Data deleted successfully');
            return back();
        }else{
            session()->flash('error', 'Data not found');
            return back();
        }
    }
}
