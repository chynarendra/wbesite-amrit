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
                                    <strong style="margin-right: 350px;"> Total Notice Count :
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

                                                        <td>
                                                            {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'from_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('From Date'),'readonly']) !!}
                                                        </td>

                                                        <td>
                                                            {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'to_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                                =>
                                                                               trans('To Date'),'readonly']) !!}
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
                                            <th width="10px">{{trans('app.sn')}}</th>
                                            <th>{{trans('Notice Title')}}</th>
                                            <th>{{trans('Notice Details')}}</th>
                                            <th>{{trans('Notice Date')}}</th>
                                            <th>{{trans('Status')}}</th>
                                            <th>{{trans('app.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                                <td>
                                                    {{$data->notice_title}}
                                                </td>
                                                <td>
                                                    {!! $data->notice_description !!}
                                                </td>

                                                <td>
                                                    {{$data->notice_date}}
                                                </td>
                                                <td>
                                                    @if($data->notice_status == '1')
                                                        <button type="button"
                                                                class="btn btn-success btn-xs">
                                                            {{trans('app.yes')}}
                                                        </button>
                                                    @elseif($data->notice_status== '0')
                                                        <button type="button"
                                                                class="btn btn-danger btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#statusModal{{$key}}"
                                                                title="Click here update  status">
                                                            {{trans('app.no')}}
                                                        </button>
                                                    @endif
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
                                                                        <div class="form-group col-md-12  {{ ($errors->has('notice_title'))?'has-error':'' }}">
                                                                            <label>{{trans('Notice Title')}}</label> <label
                                                                                    class="text text-danger"> *</label>

                                                                            {!! Form::text('notice_title',null,['class'=>'form-control','placeholder'=>'Notice Title']) !!}
                                                                            {!! $errors->first('notice_title', '<span class="text text-danger">:message</span>') !!}
                                                                        </div>
                                                                        <div class="form-group col-md-12 {{ ($errors->has('notice_description'))?'has-error':'' }}">
                                                                            <label for="inputDescription">{{trans('app.details')}}</label> <label
                                                                                    class="text text-danger"> *</label>
                                                                            {!! Form::textarea('notice_description',null,['class'=>'form-control','placeholder'=>'Enter Notice Details','rows'=>'4','autocomplete'=>'off']) !!}
                                                                            {!! $errors->first('notice_description', '<span class="label label-danger">:message</span>') !!}
                                                                        </div>


                                                                        <div class="form-group col-md-6 {{ ($errors->has('notice_date'))?'has-error':'' }}">
                                                                            <label>{{trans('Notice Date')}}</label> <label
                                                                                    class="text text-danger"> *</label>

                                                                            {!! Form::text('notice_date',null,['class'=>'form-control startDate','placeholder'=>'Notice  Date','autocomplete'=>'off']) !!}
                                                                            {!! $errors->first('notice_date', '<span class="text text-danger">:message</span>') !!}
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="status">{{trans('Notice Publish Now ?')}} </label><br>
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="readio4"
                                                                                       name="notice_status" value="1" @if($data->notice_status == 1) checked @endif>
                                                                                <label for="readio4">
                                                                                    {{trans('app.yes')}}
                                                                                </label>
                                                                            </div>
                                                                            &nbsp; &nbsp;
                                                                            <div class="icheck-success d-inline">
                                                                                <input type="radio" id="readio5"
                                                                                       name="notice_status"
                                                                                       value="0" @if($data->notice_status == 0) checked @endif>
                                                                                <label for="readio5">
                                                                                    {{trans('app.no')}}
                                                                                </label>
                                                                            </div>

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
                                            <div class="modal fade" id="statusModal{{$key}}">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content text-center">
                                                        <div class="modal-header btn-secondary">
                                                            <h4 class="modal-title"></h4>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$page_url. '/'.'status/'.$data->id]]) !!}
                                                        <div class="modal-body">
                                                                <input type="hidden" name="notice_status" value="1">
                                                                <p>Are you sure you want to publish ?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="submit"
                                                                    class="btn btn-primary">Yes
                                                            </button> &nbsp; &nbsp;
                                                            <button type="button"
                                                                    class="btn btn-default"
                                                                    data-dismiss="modal">No
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span class="float-right">{{ $results->appends(request()->except('page'))->links() }}
                                </span>
                                </div>
                                <!-- /.card-body -->
                        </div>
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
                                                    <div class="form-group col-md-12  {{ ($errors->has('notice_title'))?'has-error':'' }}">
                                                        <label>{{trans('Notice Title')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('notice_title',null,['class'=>'form-control','placeholder'=>'Notice Title']) !!}
                                                        {!! $errors->first('notice_title', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-12 {{ ($errors->has('notice_description'))?'has-error':'' }}">
                                                        <label for="inputDescription">{{trans('app.details')}}</label> <label
                                                                class="text text-danger"> *</label>
                                                        {!! Form::textarea('notice_description',null,['class'=>'form-control','placeholder'=>'Enter Notice Details','rows'=>'4','autocomplete'=>'off']) !!}
                                                        {!! $errors->first('notice_description', '<span class="label label-danger">:message</span>') !!}
                                                    </div>


                                                    <div class="form-group col-md-6 {{ ($errors->has('notice_date'))?'has-error':'' }}">
                                                        <label>{{trans('Notice Date')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('notice_date',null,['class'=>'form-control startDate','placeholder'=>'Notice  Date','autocomplete'=>'off']) !!}
                                                        {!! $errors->first('notice_date', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="status">{{trans('Notice Publish Now ?')}} </label><br>
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" id="readio3"
                                                                   name="notice_status" value="1">
                                                            <label for="readio3">
                                                                {{trans('app.yes')}}
                                                            </label>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" id="readio4"
                                                                   name="notice_status"
                                                                   value="0" checked>
                                                            <label for="readio4">
                                                                {{trans('app.no')}}
                                                            </label>
                                                        </div>

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