<?php

namespace App\Http\Controllers;

use App\Models\AppUserLeave;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AppUserLeaveController extends Controller
{
    /**
     * @param AppUserLeave $appUserLeave
     */
    private $appUserLeave;
    /**
     * @var AppUserLeaveInterface
     */
    private $appUserLeaveInterface;
    /**
     * @var ResourceController
     */
    private $resourceController;
    private $logMenu = 15;

    public function __construct(AppUserLeave $appUserLeave,AppUserLeaveInterface $appUserLeaveInterface,
                                ResourceController $resourceController){
        $this->appUserLeave=$appUserLeave;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
        $this->resourceController = $resourceController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $leaves=$this->appUserLeaveInterface->getLeavesByUser($id);
        return view('backend.AppUserLeave.index',compact('leaves','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data=$request->all();
            $create = $this->appUserLeave->create($data);

            session()->flash('success', Lang::get('app.insertMessage'));
            return back();

        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
