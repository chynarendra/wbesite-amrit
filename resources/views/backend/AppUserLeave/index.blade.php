@extends('backend.layouts.app')
<title>@yield('page_title','App User Leave/Holiday')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Leaves/Holidays'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">{{'Leaves/Holidays'}}</li>
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
                                <a class="float-right boxTopButton"
                                   data-toggle="modal"
                                   data-target="#leaveAddModal"
                                   data-placement="top" title="Add">
                                    <i class="fa fa-plus-circle fa-2x"></i>
                                </a>

                                <a href="{{url(('appUser/'.$id.'/leaves'))}}" class="float-right boxTopButton"
                                   data-toggle="tooltip" title="List"><i class="fa fa-list fa-2x"></i></a>
                                <a href="{{url(('appUser'))}}" class="float-right boxTopButton" data-toggle="tooltip"
                                   title="Go Back"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
                            </div>
                        @include('backend.AppUserLeave.add_modal')
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">{{trans('app.sn')}}</th>
                                        <th>Month Start Date</th>
                                        <th>Month End Date</th>
                                        <th>Week Off Days</th>
                                        <th>Leave</th>
                                        <th style="width: 160px">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leaves as $key=>$leave)

                                        <tr>
                                            <th scope=row>{{$key++}}</th>
                                            <td>{{$leave->month_start_date}}</td>
                                            <td>{{$leave->month_end_date}}</td>
                                            <td>
                                                <?php
                                                $holidays = $appUserRepo->getMonthHoildayDates($id, $leave->month_start_date, $leave->month_end_date)
                                                ?>
                                                @if(sizeof($holidays) > 0)
                                                    @foreach($holidays as $holiday)
                                                        {{$holiday->leave_date}} <br/>
                                                    @endforeach

                                                @endif
                                            </td>

                                            <td>
                                                <?php
                                                $leavesDates = $appUserRepo->getMonthLeaveDates($id, $leave->month_start_date, $leave->month_end_date)
                                                ?>
                                                @if(sizeof($leavesDates) > 0)
                                                    @foreach($leavesDates as $leaveDate)
                                                        {{$leaveDate->leave_date}} <br/>
                                                    @endforeach

                                                @endif

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-xs"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal{{$key}}"
                                                        data-placement="top" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @include('backend.AppUserLeave.delete_modal')
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
