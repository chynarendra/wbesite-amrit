<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchGeneralValidation;
use App\Models\Models\DispatchGeneral;
use App\Models\Models\DispatchMethod;
use App\Repository\fiscalYear\FiscalYearInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralDispatchController extends Controller
{
    //
    /**
     * @var DispatchGeneral
     */
    private $dispatchGeneral;
    /**
     * @var FiscalYearInterface
     */
    private $fiscalYear;

    public function __construct(DispatchGeneral $dispatchGeneral,FiscalYearInterface $fiscalYear){

        $this->dispatchGeneral = $dispatchGeneral;
        $this->fiscalYear = $fiscalYear;
    }
    public function index(){
        $generalDispatches=$this->dispatchGeneral->paginate(100);
        return view('GeneralDispatch.index',compact('generalDispatches'));
    }
    public function show($id){
        $data=DispatchGeneral::find($id);
        if($data){
            return view('GeneralDispatch.show',compact('data'));
        }else{
            session()->flash('error', 'Data not found !');
            return back();
        }
    }
    public function create(){
        $dispatchMethods=DispatchMethod::all();
        return view('GeneralDispatch.create',compact('dispatchMethods'));
    }

    public function store(DispatchGeneralValidation $request){
        try {
            $fiscalYear=$this->fiscalYear->getFiscalYearByDate($request->DISPATCH_DT_ENG);
            $data=$request->all();
            $data['FISCAL_YR']=$fiscalYear->code;
            $data['ENTERED_BY']=Auth::user()->full_name;
            $data['ENTERED_DT_ENG']=date('Y-m-d');
            $data['ENTERED_DT_NEP']=date('Y-m-d');
            $create=DispatchGeneral::create($data);

            session()->flash('success', 'Data inserted successfully !');
            return redirect(url('/general/dispatch'));

        }catch (\Exception $e) {
            $e->getMessage();
            dd($e);
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    public function edit($id){
        $dispatchGeneral=DispatchGeneral::find($id);
        if($dispatchGeneral){
            $dispatchMethods=DispatchMethod::all();
            return view('GeneralDispatch.edit',compact('dispatchMethods','dispatchGeneral'));
        }else{
            session()->flash('error', 'Data not found !');
            return back();
        }
    }

    public function update(DispatchGeneralValidation $request,$id){
        try {
            $generalDispatch=DispatchGeneral::find($id);
            $data=$request->all();
            $update=$generalDispatch->fill($data)->save();

            session()->flash('success', 'Data updated successfully !');
            return redirect(url('/general/dispatch'));

        }catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }

    }
    public function destroy($id){
        $dispatchGeneral=DispatchGeneral::find($id);
        if($dispatchGeneral){
            $dispatchGeneral->delete();
            session()->flash('success', 'Data deleted successfully !');
        }
        return back();
    }

}
