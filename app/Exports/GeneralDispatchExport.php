<?php


namespace App\Exports;
use App\Repository\DispatchGeneral\DispatchGeneralInterface;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GeneralDispatchExport implements FromView
{
    /**
     * @var DispatchGeneralInterface
     */
    private $dispatchGeneral;
    /**
     * @var Request
     */
    private $request;

    public function __construct($dispatchGeneral,$request)
    {
        $this->dispatchGeneral = $dispatchGeneral;
        $this->request = $request;
    }

    public function view(): View
    {
        $dispatchGenerals=$this->dispatchGeneral;
        $request=$this->request;
        return view('Exports.dispatchGeneral',compact('dispatchGenerals','request'));
    }
}