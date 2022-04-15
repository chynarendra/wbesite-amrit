@extends('backend.layouts.app')
<title>@yield('page_title','Information Dispatch (General)')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Information Dispatch (General)'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('/general/info')}}">{{'Information Dispatch (General)'}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.list')}}</li>
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
                                <h3 class="card-title">Information Dispatch General</h3>

                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('report/general/dispatch')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="card">
                            <table class="table table-responsive p-0" width="100%">
                                <form action="{{url('report/general/dispatch')}}" autocomplete="off">
                                    <tr>
                                        <td>
                                            {!! Form::select('dispatch_method',$dispatchMethods->pluck('METHOD_CD','METHOD_CD'),null,['class'=>'form-control','placeholder'=>'Select Dispatch Method']) !!}
                                        </td>
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
                                            <a href="{{url('report/general/dispatch')}}" class="btn btn-danger cutsom-btn"> <i class="fas fa-sync-alt"></i> {{trans('app.refresh')}}</a>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body">
                                <span>Date : {{isset($request->from_date)?$request->from_date:''}} To {{isset($request->to_date)?$request->to_date:''}}</span>
                                <table id="example2"
                                       class="table table-striped table-bordered table-hover table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">S.N.</th>
                                        <th colspan="3">Dispatch</th>
                                        <th rowspan="2">Ref. No.</th>
                                        <th rowspan="2">Issued To</th>
                                        <th rowspan="2">Address</th>
                                        <th rowspan="2">Subject</th>
                                        <th rowspan="2">User</th>
                                    </tr>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Method</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dispatchGenerals as $key=>$dispatchGeneral)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$dispatchGeneral->DISPATCH_NO}}</td>
                                            <td>{{$dispatchGeneral->DISPATCH_DT_NEP}}</td>
                                            <td>{{$dispatchGeneral->DISPATCH_METHOD}}</td>
                                            <td>{{$dispatchGeneral->REF_NO}}</td>
                                            <td>{{$dispatchGeneral->ISSUED_TO}}</td>
                                            <td>{{$dispatchGeneral->ADDRESS}}</td>
                                            <td>{{$dispatchGeneral->SUBJECT}}</td>
                                            <td>{{$dispatchGeneral->ENTERED_BY}}</td>
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
