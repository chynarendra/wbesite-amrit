@extends('backend.layouts.app')
<title>@yield('page_title','Leaves')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Leaves'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">{{'Leaves'}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="text-align:right">
                                <h3 class="card-title">{{trans('app.list')}}</h3>

                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];

                                ?>

                                <a href="{{url(('leaves'))}}" class="float-right boxTopButton"
                                   data-toggle="tooltip" title="List"><i class="fa fa-list fa-2x"></i></a>

                                @if($allowAdd)
                                    <a href="javascript:main(0)" style="margin-right: 3px;" class="pull-right"
                                       data-toggle="modal"
                                       data-target="#addModal"
                                       title="Add New">
                                        <i class="fa fa-plus-circle fa-2x"></i></a>
                                @endif
                                @include('backend.leave.addModal')


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="accordion">
                                        <div class="card-header">
                                            <h4 class="card-title float-right">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#search">
                                                    <i class="fas fa-filter"></i>Filter
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="search"
                                             class="panel-collapse collapse @if($request->app_user_id != null ||  $request->month_start_date != null ||  $request->month_end_date != null ||  $request->status != null)show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form
                                                        action="{{url('leaves')}}" autocomplete="off">
                                                    <tr>
                                                        <td>
                                                            {{Form::select('app_user_id',$appUsers->pluck('full_name','id'),Request::get('app_user_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                            'Select App User'])}}

                                                        </td>

                                                        <td>
                                                            {{Form::select('status',$statuses,Request::get('status'),['class'=>'form-control select2','placeholder'=>
                                                            'Select Status'])}}

                                                        </td>

                                                        <td>
                                                            {!!Form::text('month_start_date',Request::get('month_start_date'),['class'=>'form-control','id'=>'month_start_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('From Date'),'readonly']) !!}
                                                        </td>

                                                        <td>
                                                            {!!Form::text('month_end_date',Request::get('month_end_date'),['class'=>'form-control','id'=>'month_end_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                                =>
                                                                               trans('To Date'),'readonly']) !!}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"
                                                            class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                        class="fa fa-search"></i> {{trans('app.filter')}}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{url('leaves')}}"
                                                               class="btn btn-default"> <i
                                                                        class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                            </a>
                                                            &nbsp; &nbsp;
                                                            <a class="btn btn-danger" data-toggle="collapse"
                                                               data-parent="#accordion" href="#search">
                                                                <span aria-hidden="true">&times;</span> Close
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </form>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>User</th>
                                        <th>Leave Dates</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(sizeof($leaves) > 0)

                                        @foreach($leaves as $key=>$leave)
                                            <tr>
                                                <th scope=row>{{ ($leaves->currentpage()-1) * $leaves->perpage() + $key+1 }}</th>
                                                <td>{{$leave->appUser->full_name}}</td>
                                                <td>
                                                    <?php
                                                    $leaveDate = new \DateTime($leave->leave_date);
                                                    $formattedLeaveDate = $leaveDate->format('jS, F Y');
                                                    ?>
                                                    {{$formattedLeaveDate}}
                                                </td>
                                                <td>{!! $leave->reason !!}</td>
                                                <td>
                                                    @if($leave->status=='Approved')
                                                        <button class="btn btn-success btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{$key}}"
                                                                data-placement="top"
                                                                title="Update Status">{{$leave->status}}</button>

                                                    @elseif($leave->status=='Cancelled')
                                                        <button class="btn btn-danger btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{$key}}"
                                                                data-placement="top"
                                                                title="Update Status">{{$leave->status}}</button>
                                                    @else
                                                        <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{$key}}"
                                                                data-placement="top"
                                                                title="Update Status">{{$leave->status}}</button>
                                                    @endif

                                                    @include('backend.leave.status_modal')
                                                </td>
                                                <td>
                                                    @if($allowEdit)
                                                        <button type="button" class="btn btn-info btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{$key}}"
                                                                data-placement="top" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        @include('backend.leave.editModal')
                                                    @endif
                                                    @if($allowDelete)
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{$key}}"
                                                                data-placement="top" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <?php $data=$leave;?>
                                                        @include('backend.modal.delete_modal')
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach

                                    @endif

                                    </tbody>
                                </table>

                                {{ $leaves->appends(request()->except('page'))->links() }}

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"/>

@endsection
