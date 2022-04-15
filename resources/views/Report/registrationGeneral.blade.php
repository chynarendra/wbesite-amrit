@extends('backend.layouts.app')
<title>@yield('page_title','Information Registration (General)')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Information Registration (General)'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('/report/general/registration')}}">{{'Information Registration (General)'}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.report')}}</li>
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
                                <h3 class="card-title">Information Registration (General)</h3>

                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/report/general/registration')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="card">
                            <table class="table table-responsive p-0" width="100%">
                                <form action="{{url('/report/general/registration')}}" autocomplete="off">
                                    <tr>
                                        <td>
                                            {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'refDateNp','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                               trans('From Date'),'readonly']) !!}
                                        </td>
                                        <td>
                                            {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'regDateNp','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                =>trans('To Date'),'readonly']) !!}
                                        </td>
                                        <td colspan="5" class="text-center">
                                            <button type="submit" class="btn btn-primary cutsom-btn" name="click" value="filter"><i class="fa fa-search"></i> {{trans('app.filter')}}</button>
                                            <button type="submit" class="btn btn-success cutsom-btn" name="click" value="excel"><i class="fa fa-file-alt"></i> {{'Excel'}}</button>
                                            <a href="{{url('/report/general/registration')}}" class="btn btn-danger cutsom-btn"> <i class="fas fa-sync-alt"></i> {{trans('app.refresh')}}</a>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body">
                                <span>Date : {{isset($request->from_date)?$request->from_date:''}} To {{isset($request->to_date)?$request->to_date:''}}</span>
                                <table id="example4"
                                       class="table table-striped table-bordered table-hover table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Reg. Date</th>
                                        <th>Reg. No</th>
                                        <th>Ref. No.</th>
                                        <th>Ref. Date</th>
                                        <th>Issued To</th>
                                        <th>Address</th>
                                        <th>Subject</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($registrationGenerals as $key=>$registrationGeneral)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$registrationGeneral->REG_DT_NEP}}</td>
                                            <td>{{$registrationGeneral->REG_NO}}</td>
                                            <td>{{$registrationGeneral->REF_NO}}</td>
                                            <td>{{$registrationGeneral->REF_DT_NEP}}</td>
                                            <td>{{$registrationGeneral->ISSUED_BY}}</td>
                                            <td>{{$registrationGeneral->ADDRESS}}</td>
                                            <td>{{$registrationGeneral->SUBJECT}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- Add Modal Start -->
                        <!-- /.row -->
                        <!-- /.container-fluid -->
                        <!-- /.content -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
