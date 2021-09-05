@extends('backend.layouts.app')
<title>@yield('page_title',$page_title)</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$page_title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{$page_title}}</a></li>
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
                                <h3 class="card-title">{{trans('app.list')}}</h3>
                                @if($request->city_id != null ||  $request->from_date != null ||  $request->to_date != null)
                                    <strong style="margin-right: 350px;"> Total Campaign Count :
                                        <span style="font-size: 16px; color: #007bff;">{{$totalResult}}</span>
                                    </strong>
                                @endif


                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];

                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url($page_url)}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="" class="pull-right" data-toggle="modal"
                                       data-target="#addModal"
                                       title="Add New">
                                        <i class="fa fa-plus-circle fa-2x"></i></a>
                                @endif
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
                                             class="panel-collapse collapse @if($request->city_id != null ||  $request->from_date != null ||  $request->to_date != null)show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form
                                                        action="{{url($page_url)}}" autocomplete="off">
                                                    <tr>
                                                        <td style="width: 25%">
                                                            {{Form::select('city_id',$cityList->pluck('city_name','id'),Request::get('city_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                     'Select City'])}}

                                                        </td>

                                                        <td>
                                                            {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'from_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('app.start_date'),'readonly']) !!}
                                                        </td>

                                                        <td>
                                                            {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'to_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                                =>
                                                                               trans('app.start_date'),'readonly']) !!}
                                                        </td>


                                                        <td colspan="5"
                                                            class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                        class="fa fa-search"></i> {{trans('app.filter')}}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{url($page_url)}}"
                                                               class="btn btn-default"> <i
                                                                        class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                            </a>
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
                        @if(sizeof($results) > 0)
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="10px">{{trans('app.sn')}}</th>
                                        <th>{{trans('app.name')}}</th>
                                        <th>{{trans('City')}}</th>
                                        <th>Start / End Date</th>
                                        <th>Description</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $key=>$data)
                                        <tr>
                                            <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                            <td>
                                                {{$data->campaign_name}}
                                            </td>
                                            <td>
                                                @if(isset($data->city->city_name))
                                                    {{$data->city->city_name}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->start_date}} / {{$data->end_date}}
                                            </td>
                                            <td>
                                            {{$data->description}}
                                            </td>
                                            <td>
                                                @if($allowEdit)
                                                    <button type="button" class="btn btn-info btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{$key}}"
                                                            data-placement="top" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                @endif
                                                @if($allowDelete)
                                                    <button type="button" class="btn btn-danger btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{$key}}"
                                                            data-placement="top" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif

                                            </td>
                                        </tr>
                                        @include('backend.modal.delete_modal')



                                        <div class="modal fade" id="editModal{{$key}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-secondary">
                                                        <h4 class="modal-title">{{trans('app.edit')}}</h4>
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true" data-toggle="tooltip"
                                                                      title="Close">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                {!! Form::model($data,['method'=>'PUT','route'=>[$page_route.'.'.'update',$data->id]]) !!}
                                                                <div class="row">
                                                                    <div class="form-group col-md-6 {{ ($errors->has('city_id'))?'has-error':'' }}">
                                                                        <label>{{trans('City Name ')}}</label>
                                                                        <label
                                                                                class="text text-danger"> *</label>
                                                                        {{Form::select('city_id',$cityList->pluck('city_name','id'),Request::get('city_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                    'Select City'])}}

                                                                        {!! $errors->first('district_id', '<span class="text text-danger">:message</span>') !!}
                                                                    </div>
                                                                    <div class="form-group col-md-6  {{ ($errors->has('campaign_name'))?'has-error':'' }}">
                                                                        <label>{{trans('app.name')}}</label> <label
                                                                                class="text text-danger"> *</label>

                                                                        {!! Form::text('campaign_name',null,['class'=>'form-control','placeholder'=>'Campaign Name']) !!}
                                                                        {!! $errors->first('campaign_name', '<span class="text text-danger">:message</span>') !!}
                                                                    </div>
                                                                    <div class="form-group col-md-6 {{ ($errors->has('start_date'))?'has-error':'' }}">
                                                                        <label>{{trans('app.start_date')}}</label>
                                                                        <label
                                                                                class="text text-danger"> *</label>

                                                                        {!! Form::text('start_date',null,['class'=>'form-control startDate','placeholder'=>'Campaign Start Date']) !!}
                                                                        {!! $errors->first('start_date', '<span class="text text-danger">:message</span>') !!}
                                                                    </div>
                                                                    <div class="form-group col-md-6 {{ ($errors->has('end_date'))?'has-error':'' }}">
                                                                        <label>{{trans('app.end_date')}}</label>
                                                                        <label
                                                                                class="text text-danger"> *</label>

                                                                        {!! Form::text('end_date',null,['class'=>'form-control endDate','placeholder'=>'Campaign End Date']) !!}
                                                                        {!! $errors->first('end_date', '<span class="text text-danger">:message</span>') !!}
                                                                    </div>
                                                                    <div class="form-group col-md-12 {{ ($errors->has('details'))?'has-error':'' }}">
                                                                        <label for="inputDescription">{{trans('app.details')}}</label>
                                                                        {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Enter Campaign Details','rows'=>'4','autocomplete'=>'off']) !!}
                                                                        {!! $errors->first('description', '<span class="label label-danger">:message</span>') !!}
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer justify-content-center">

                                                                    <button type="submit"
                                                                            class="btn btn-success">{{trans('app.update')}}</button>
                                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                                    <button type="button"
                                                                            class="btn btn-danger"
                                                                            data-dismiss="modal">
                                                                        {{trans('app.cancel')}}
                                                                    </button>
                                                                </div>
                                                                {!! Form::close() !!}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right">{{ $results->appends(request()->except('page'))->links() }}
                                </span>
                            </div>
                            <!-- /.card-body -->
                        @else
                            <div class="col-md-12" style="padding-top: 10px">
                                <label class="form-control badge badge-info"
                                       style="text-align:  center; font-size: 18px;">
                                    <i class="fas fa-ban"></i> No record found yet !.
                                </label>
                            </div>
                    </div>
                @endif
                <!-- /.card -->


                    <div class="modal fade" id="addModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #6c757d">
                                    <h4 class="modal-title">{{trans('app.add')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            {!! Form::open(['method'=>'post','url'=>$page_url]) !!}
                                            <div class="row">
                                                <div class="form-group col-md-6 {{ ($errors->has('city_id'))?'has-error':'' }}">
                                                    <label>{{trans('City Name ')}}</label> <label
                                                            class="text text-danger"> *</label>
                                                    {{Form::select('city_id',$cityList->pluck('city_name','id'),Request::get('city_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                'Select City'])}}

                                                    {!! $errors->first('city_id', '<span class="text text-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group col-md-6  {{ ($errors->has('campaign_name'))?'has-error':'' }}">
                                                    <label>{{trans('app.name')}}</label> <label
                                                            class="text text-danger"> *</label>

                                                    {!! Form::text('campaign_name',null,['class'=>'form-control','placeholder'=>'Campaign Name']) !!}
                                                    {!! $errors->first('campaign_name', '<span class="text text-danger">:message</span>') !!}
                                                </div>

                                                <div class="form-group col-md-6 {{ ($errors->has('start_date'))?'has-error':'' }}">
                                                    <label>{{trans('app.start_date')}}</label> <label
                                                            class="text text-danger"> *</label>

                                                    {!! Form::text('start_date',null,['class'=>'form-control startDate','placeholder'=>'Campaign Start Date','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('start_date', '<span class="text text-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group col-md-6 {{ ($errors->has('end_date'))?'has-error':'' }}">
                                                    <label>{{trans('app.end_date')}}</label> <label
                                                            class="text text-danger"> *</label>

                                                    {!! Form::text('end_date',null,['class'=>'form-control endDate','placeholder'=>'Campaign End Date','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('end_date', '<span class="text text-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group col-md-12 {{ ($errors->has('details'))?'has-error':'' }}">
                                                    <label for="inputDescription">{{trans('app.details')}}</label>
                                                    {!! Form::textarea('description',null,['class'=>'form-control','placeholder'=>'Enter Campaign Details','rows'=>'4','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('description', '<span class="label label-danger">:message</span>') !!}
                                                </div>

                                            </div>


                                            <div class="modal-footer justify-content-center">

                                                <button type="submit"
                                                        class="btn btn-primary">{{trans('app.save')}}</button>
                                                &nbsp; &nbsp;
                                                <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">
                                                    {{trans('app.cancel')}}
                                                </button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

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