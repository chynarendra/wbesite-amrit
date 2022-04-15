<?php


namespace App\Repository\DispatchGeneral;


use App\Models\Models\DispatchGeneral;
use App\Models\Models\RegistrationGeneral;

class DispatchGeneralRepository implements DispatchGeneralInterface
{
    /**
     * @var DispatchGeneral
     */
    private $dispatchGeneral;
    /**
     * @var RegistrationGeneral
     */
    private $registrationGeneral;

    public function __construct(DispatchGeneral $dispatchGeneral,RegistrationGeneral $registrationGeneral)
    {
        $this->dispatchGeneral = $dispatchGeneral;
        $this->registrationGeneral = $registrationGeneral;
    }

    public function allDispatchGenerals($request){
        $data=$this->dispatchGeneral;
        if($request->dispatch_method !=null){
            $data=$data->where('DISPATCH_METHOD',$request->dispatch_method);
        }
        if($request->from_date !=null){
            if($request->to_date !=null){
                $data=$data->whereBetween('DISPATCH_DT_NEP',[$request->from_date,$request->to_date]);
            }else{
                $data=$data->where('DISPATCH_DT_NEP',$request->from_date);
            }
        }
        $data=$data->get();
        return $data;
    }

    public function allRegistrationGenerals($request){
        $data=$this->registrationGeneral;
        if($request->from_date !=null){
            if($request->to_date !=null){
                $data=$data->whereBetween('REG_DT_NEP',[$request->from_date,$request->to_date]);
            }else{
                $data=$data->where('REG_DT_NEP',$request->from_date);
            }
        }
        $data=$data->get();
        return $data;
    }
}