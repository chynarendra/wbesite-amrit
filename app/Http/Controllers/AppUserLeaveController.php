<?php

namespace App\Http\Controllers;

use App\Models\AppUserLeave;
use App\Repository\appUserRepository\AppUserLeaveInterface;
use Illuminate\Http\Request;

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

    public function __construct(AppUserLeave $appUserLeave,AppUserLeaveInterface $appUserLeaveInterface){
        $this->appUserLeave=$appUserLeave;
        $this->appUserLeaveInterface = $appUserLeaveInterface;
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
        dd($leaves);
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
        //
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
