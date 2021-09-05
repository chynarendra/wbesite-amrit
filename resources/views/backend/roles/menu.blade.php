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
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">{{$page_title}}</li>
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

                                            <?php

                                            $permission = helperPermission();

                                            $allowEdit = $permission['isEdit'];

                                            ?>
                                            <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                               title="Add New">
                                                <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                            <a href="{{url('/roles/menu')}}" class="pull-right" data-toggle="tooltip"
                                               title="View List">
                                                <i class="fa fa-list fa-2x"></i></a>

                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{trans('app.sn')}}</th>
                                                    <th>{{trans('app.parentMenu')}}</th>
                                                    <th>{{trans('app.menuName')}}</th>
                                                    <th>{{trans('app.controllerLink')}} / {{trans('app.menuLink')}}</th>
                                                    <th class="text-center">{{trans('app.icon')}}</th>
                                                    <th style="width: 30px"
                                                        class="text-centered">{{trans('app.status')}}</th>
                                                    <th class="text-right">{{trans('app.order')}}</th>
                                                    <th width="80px">{{trans('app.action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($menus as $key=>$data)
                                                    <tr>
                                                        <th scope=row>{{ ($menus->currentpage()-1) * $menus->perpage() + $key+1 }}</th>
                                                        <td>
                                                            @if(isset($data->parent->menu_name))

                                                                <label class="badge badge-secondary"> {{$data->parent->menu_name}}</label>
                                                            @else
                                                                <label class="badge badge-info">Is a Parent</label>
                                                            @endif
                                                        </td>
                                                        <td>{{$data->menu_name}}</td>
                                                        <td>
                                                            @if($data->menu_controller !=null)
                                                                {{$data->menu_controller}}
                                                                <br>
                                                                {{$data->menu_link}}
                                                            @else
                                                                <label class="badge badge-info"> Parent Menu</label>

                                                            @endif
                                                        </td>

                                                        <td class="text-center">  <i class="{!! $data->menu_icon !!}" aria-hidden="true"></i></td>
                                                        <td>
                                                            @if($data->menu_status == '1')
                                                                <button type="button"
                                                                        class="btn btn-success btn-xs"
                                                                        data-toggle="modal"
                                                                        data-target="#statusModal{{$key}}"
                                                                        title="Click here update  status">
                                                                    {{trans('app.active')}}
                                                                </button>
                                                            @elseif($data->menu_status== '0')
                                                                <button type="button"
                                                                        class="btn btn-danger btn-xs"
                                                                        data-toggle="modal"
                                                                        data-target="#statusModal{{$key}}"
                                                                        title="Click here update  status">
                                                                    {{trans('app.inactive')}}
                                                                </button>
                                                            @endif
                                                        </td>
                                                        <!-- status modal start -->
                                                        <div class="modal fade" id="statusModal{{$key}}">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                         style="background: #ffc107">
                                                                        <h4 class="modal-title"></h4>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['roles/menu/menuControllerChangeStatus/'.$data->id]]) !!}
                                                                    <div class="modal-body">
                                                                        @if($data->menu_status == 1)
                                                                            <input type="hidden" name="status" value="0">
                                                                            <p>Are you sure you want to
                                                                                inactive?</p>
                                                                        @else
                                                                            <input type="hidden" name="status" value="1">
                                                                            <p>Are you sure you want to active?</p>
                                                                        @endif
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
                                                        <!-- /.modal -->
                                                        <td class="text-center">
                                                            {{$data->menu_order}}
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
                                                                <!-- Edit Modal Start -->
                                                                    <div class="modal fade" id="editModal{{$key}}">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content" style="width: 600px;">
                                                                                <div class="modal-header" style="background: #6c757d">
                                                                                    <h4 class="modal-title">{{trans('app.add')}}</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    {!! Form::model($data,['method'=>'PUT','route'=>['menu.update',$data->id]]) !!}
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-6 {{ ($errors->has('parent_id'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.parentMenu')}}</label> <label
                                                                                                    class="text text-danger"> *</label>
                                                                                            {{Form::select('parent_id',$parentList->pluck('menu_name','id'),Request::get('parent_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                                        'Select Parent Menu'])}}

                                                                                            {!! $errors->first('user_type_id', '<span class="test text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6  {{ ($errors->has('menu_name'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.name')}}</label> <label
                                                                                                    class="text text-danger"> *</label>

                                                                                            {!! Form::text('menu_name',null,['class'=>'form-control','placeholder'=>'Enter Menu Name']) !!}
                                                                                            {!! $errors->first('menu_name', '<span class="test text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 {{ ($errors->has('login_user_name'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.controller')}}</label> <label
                                                                                                    class="text text-danger"> *</label>

                                                                                            {!! Form::text('menu_controller',null,['class'=>'form-control','placeholder'=>'Enter Menu Controller Name']) !!}
                                                                                            {!! $errors->first('menu_controller', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 {{ ($errors->has('menu_link'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.menuLink')}}</label> <label
                                                                                                    class="text text-danger"> *</label>

                                                                                            {!! Form::text('menu_link',null,['class'=>'form-control','placeholder'=>'fa fa-users']) !!}
                                                                                            {!! $errors->first('menu_link', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 {{ ($errors->has('menu_icon'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.icon')}}</label> <label
                                                                                                    class="text text-danger"> *</label>

                                                                                            {!! Form::text('menu_icon',null,['class'=>'form-control','placeholder'=>'Enter Menu Icon']) !!}
                                                                                            {!! $errors->first('menu_icon', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6 {{ ($errors->has('menu_order'))?'has-error':'' }}">
                                                                                            <label>{{trans('app.order')}}</label> <label
                                                                                                    class="text text-danger"> *</label>

                                                                                            {!! Form::number('menu_order',null,['class'=>'form-control','min'=>'1']) !!}
                                                                                            {!! $errors->first('menu_order', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label for="status">{{trans('app.status')}} </label><br>
                                                                                            <div class="icheck-success d-inline">
                                                                                                <input type="radio" id="readio1"
                                                                                                       name="status" value="1"
                                                                                                       checked>
                                                                                                <label for="readio1">
                                                                                                    {{trans('app.active')}}
                                                                                                </label>
                                                                                            </div>
                                                                                            &nbsp; &nbsp;
                                                                                            <div class="icheck-success d-inline">
                                                                                                <input type="radio" id="readio2"
                                                                                                       name="status"
                                                                                                       value="0">
                                                                                                <label for="readio2">
                                                                                                    {{trans('app.inactive')}}
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>


                                                                                    </div>


                                                                                    <div class="modal-footer justify-content-center">

                                                                                        <button type="submit"
                                                                                                class="btn btn-primary">{{trans('app.save')}}</button>
                                                                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                                                                        <button type="button" class="btn btn-danger"
                                                                                                data-dismiss="modal">
                                                                                            {{trans('app.cancel')}}
                                                                                        </button>
                                                                                    </div>
                                                                                    {!! Form::close() !!}
                                                                                </div>
                                                                                <!-- /.modal-content -->
                                                                            </div>
                                                                            <!-- /.modal-dialog -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- /Add Modal End -->
                                                            </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <span
                                                    class="float-right">{{ $menus->appends(request()->except('page'))->links() }}
                                            </span>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                            <!-- /.col -->
                        </div>
                </div>
                <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
