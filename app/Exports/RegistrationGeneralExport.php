<?php


namespace App\Exports;
use App\Repository\DispatchGeneral\DispatchGeneralInterface;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationGeneralExport implements FromView
{
    private $request;
    private $registrationGenerals;

    public function __construct($registrationGenerals,$request)
    {
        $this->request = $request;
        $this->registrationGenerals = $registrationGenerals;
    }

    public function view(): View
    {
        $registrationGenerals=$this->registrationGenerals;
        $request=$this->request;
        return view('Exports.registrationGeneral',compact('registrationGenerals','request'));
    }
}