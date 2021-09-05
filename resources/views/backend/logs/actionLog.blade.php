@extends('backend.layouts.app')
<title>@yield('page_title',trans('app.logs'))</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('app.logs')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{trans('app.logs')}}</a></li>
                            <li class="breadcrumb-item">{{$page_title}}</li>
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
                            <div class="card-header" style="text-align:center">
                                <h3 class="card-title">{{$page_title}}</h3>
                                @if($request->user_id != null ||  $request->action_name != null ||  $request->module_name != null  || $request->from_date != null || $request->from_date != null )
                                    <strong> Total Action Count : </strong>  <strong
                                            style="font-size: 16px; color: #007bff;">{{$totalLogs}}</strong>
                                @endif
                                <a href="{{URL::previous()}}" class="float-right" data-toggle="tooltip"
                                   title="Go Back">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i>
                                </a>
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
                                        <div id="search" class="panel-collapse collapse @if($request->user_id != null ||  $request->action_name != null ||  $request->module_name != null  || $request->from_date != null || $request->from_date != null )show @endif">
                                                <table class="table table-responsive p-0" width="100%">
                                                    <form
                                                            action="{{url('/logs/actionLogs')}}" autocomplete="off">
                                                        <tr>
                                                            <td>
                                                                {{Form::select('user_id',$users->pluck('full_name','id'),Request::get('user_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                                'Select User Name'])}}
                                                            </td>

                                                            <td>
                                                                {{Form::select('module_name',$moduleNames->pluck('menu_name','id'),Request::get('module_name'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                                'Select Module  Name'])}}
                                                            </td>
                                                            <td>
                                                                {{Form::select('action_name',$actionNames,Request::get('action_name'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                                'Select Action   Name'])}}
                                                            </td>

                                                            <td>
                                                                {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'from_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                                   trans('app.fromDate')]) !!}
                                                            </td>

                                                            <td>
                                                                {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'to_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                                    =>
                                                                                   trans('app.toDate'),'readonly']) !!}
                                                            </td>

                                                        </tr>
                                                        <tr>

                                                            <td colspan="5"
                                                                class="text-center">
                                                                <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i> {{trans('app.filter')}}
                                                                </button> &nbsp; &nbsp;
                                                                <a href="{{url('/logs/actionLogs')}}"
                                                                   class="btn btn-default"> <i
                                                                            class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                                </a>
                                                                &nbsp; &nbsp;
                                                                <a  class="btn btn-danger" data-toggle="collapse" data-parent="#accordion" href="#search">
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

                        </div>
                        <!-- /.card-header -->
                        @if(sizeof($results) > 0)
                            <div class="card">
                                <div class="card-body">
                                    <table id="example2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="10px;">{{trans('app.sn')}}</th>
                                            <th width="150px;">{{trans('Action By')}}</th>
                                            <th width="150px;">{{trans('app.ip')}}</th>
                                            <th width="400px;">{{trans('app.device')}}</th>
                                            <th width="150px;">{{trans('app.actionModule')}}</th>
                                            <th width="120px;">{{trans('app.actionName')}}</th>
                                            <th width="150px;">{{trans('app.date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                                <td>
                                                    @if(isset($data->user->full_name))
                                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $data->action_user_id)
                                                            <strong class="badge badge-secondary">You</strong>
                                                        @else
                                                            {{$data->user->full_name}}
                                                        @endif
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>

                                                <td>
                                                    {{$data->action_ip}}
                                                </td>

                                                <td>
                                                    {{$data->action_device}}
                                                </td>

                                                <td>
                                                    @if(isset($data->menuName->menu_name))
                                                        <strong
                                                                class="badge badge-secondary">{{$data->menuName->menu_name}}</strong>
                                                    @else
                                                        <strong class="badge badge-info">Other</strong>
                                                    @endif
                                                </td>

                                                <td>

                                                    @if($data->action_name == '1')
                                                        <strong class="badge badge-primary">{{moduleAction($data->action_name)}}</strong>
                                                    @elseif($data->action_name == '2' || $data->action_name == '5' || $data->action_name == '7' || $data->action_name == '8')
                                                        <strong class="badge badge-success">
                                                            {{moduleAction($data->action_name)}}
                                                        </strong>
                                                    @elseif($data->action_name == '4' || $data->action_name == 6)
                                                        <strong class="badge badge-danger">
                                                            {{moduleAction($data->action_name)}}
                                                        </strong>
                                                    @elseif($data->action_name == '3')
                                                        <strong class="badge badge-secondary">{{moduleAction($data->action_name)}}</strong>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{$data->action_date}}

                                                    &nbsp; &nbsp; <span
                                                            class="badge badge-secondary"><i class="far fa-clock"> </i>  {{ \Carbon\Carbon::parse($data->action_date)->diffForHumans() }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span class="float-right"> {{ $results->appends(request()->except('page'))->links() }}
                                </span>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        @else
                            <div class="col-md-12" style="padding-top: 10px">
                                <label class="form-control badge badge-info"
                                       style="text-align:  center; font-size: 18px;">
                                    <i class="fas fa-ban"></i> No record found yet !.
                                </label>
                            </div>
                            <!-- /.card -->
                    </div>
                @endif
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection