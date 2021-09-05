@extends('backend.layouts.app')
<title>@yield('page_title',trans('app.mailSetting'))</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('app.systemSetting')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{trans('app.systemSetting')}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.mailSetting')}}</li>
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
                                <h3 class="card-title">{{trans('app.mailSetting')}}</h3>


                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Go Back">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/systemSetting/mailSetting')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{trans('app.mailFrom')}}</th>
                                        <th>{{trans('app.mailDriver')}}</th>
                                        <th>{{trans('app.mailHostName')}}</th>
                                        <th>{{trans('app.mailPort')}}</th>
                                        <th>{{trans('app.mailUserName')}}</th>
                                        <th>{{trans('app.mailPassword')}}</th>
                                        <th>{{trans('app.mailEncryption')}}</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if(isset($result['mail_from_address']))
                                                {{$result['mail_from_address']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_driver']))
                                                {{$result['mail_driver']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_host_name']))
                                                {{$result['mail_host_name']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_port']))
                                                {{$result['mail_port']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_user_name']))
                                                {{$result['mail_user_name']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_password']))
                                                {{$result['mail_password']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($result['mail_encryption']))
                                                {{$result['mail_encryption']}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($allowEdit)
                                                <button type="button" class="btn btn-info btn-xs"
                                                        data-toggle="modal"
                                                        data-target="#editModal"
                                                        data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="editModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header btn-secondary">
                                                <h4 class="modal-title">{{trans('app.update')}}</h4>
                                                <button type="button" class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::model($result,['method'=>'PUT','route'=>[$page_route.'.'.'update',$result['id']],'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailFrom')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_from_address',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_from_address', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailDriver')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_driver',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_driver', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailHostName')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_host_name',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_host_name', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailPort')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_port',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_port', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailUserName')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_user_name',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_user_name', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailPassword')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_password',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_password', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.mailEncryption')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::text('mail_encryption',null,['class'=>'form-control','required']) !!}
                                                        {!! $errors->first('mail_encryption', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-center">

                                                    <button type="submit"
                                                            class="btn btn-success">{{trans('app.update')}}</button>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">
                                                        {{trans('app.cancel')}}
                                                    </button>
                                                </div>

                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
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