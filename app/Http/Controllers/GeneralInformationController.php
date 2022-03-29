<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralInformationValidation;
use App\Models\Models\RegistrationGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class GeneralInformationController extends BaseController
{
    //
    /**
     * @var RegistrationGeneral
     */
    private $registrationGeneral;

    public function __construct(RegistrationGeneral $registrationGeneral){
        $this->registrationGeneral = $registrationGeneral;
    }

    public function index(){
        $infos=$this->registrationGeneral::paginate(100);
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
            $data=$request->all();
            $create=RegistrationGeneral::create($data);
            session()->flash('success', Lang::get('app.insertMessage'));
            return redirect(url('general/info'));
        } catch (\Exception $e) {
            $e->getMessage();
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
