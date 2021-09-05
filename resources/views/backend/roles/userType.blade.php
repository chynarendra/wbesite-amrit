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
                        <h1 class="m-0">{{trans('app.roles')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{trans('app.roles')}}</a></li>
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
                            <div class="card-header" style="text-align:right">
                                <h3 class="card-title">{{trans('app.userType')}}</h3>


                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];

                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/roles/type')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="" class="pull-right" data-toggle="modal"
                                       data-target="#addModal"
                                       title="Add New">
                                        <i class="fa fa-plus-circle fa-2x"></i></a>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="10px">{{trans('app.sn')}}</th>
                                        <th>{{trans('app.name')}}</th>
                                        <th>{{trans('app.details')}}</th>
                                        <th>{{trans('app.status')}}</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $key=>$data)
                                        <tr>
                                            <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                            <td>{{$data->type_name}}</td>
                                            <td>
                                                @if(isset($data->details))
                                                    {{$data->details}}
                                                @else
                                                    Not Available
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->status == '1')
                                                    <button type="button" class="btn btn-success btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#statusModal{{$key}}"
                                                            title="Click here update  status">
                                                        {{trans('app.active')}}
                                                    </button>
                                                @elseif($data->status== '0')
                                                    <button type="button" class="btn btn-danger btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#statusModal{{$key}}"
                                                            title="Click here update  status">
                                                        {{trans('app.inactive')}}
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
                                    @endforeach
                                    </tbody>
                                </table>
                                <span
                                        class="float-right">{{ $results->appends(request()->except('page'))->links() }}
                                </span>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="modal fade" id="statusModal{{$key}}">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content text-center">
                                    <div class="modal-header btn-secondary">
                                        <h4 class="modal-title"></h4>
                                        <button type="button" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                        </button>
                                    </div>
                                    {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['roles/type/status/'.$data->id]]) !!}
                                    <div class="modal-body">
                                        @if($data->status == 1)

                                            <p>Are you sure you want to inactive?</p>
                                        @else
                                            <p>Are you sure you want to active?</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            Yes
                                        </button> &nbsp; &nbsp;
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">No
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>


                        <div class="modal fade" id="editModal{{$key}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header btn-secondary">
                                        <h4 class="modal-title">{{trans('app.edit')}}</h4>
                                        <button type="button" class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                {!! Form::model($data,['method'=>'PUT','route'=>['type.update',$data->id]]) !!}
                                                <div class="form-group">
                                                    <label for="inputName">{{trans('app.name')}}</label>
                                                    {!! Form::text('type_name',null,['class'=>'form-control','placeholder'=>'Enter User Type  Name','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('type_name', '<small class="text text-danger">:message</small>') !!}
                                                </div>
                                                <div class="form-group {{ ($errors->has('details'))?'has-error':'' }}">
                                                    <label for="inputDescription">{{trans('app.details')}}</label>
                                                    {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Enter User Type Description','rows'=>'4','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('details', '<span class="label label-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">{{trans('app.status')}} </label><br>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="readio1"
                                                               name="status" value="1"
                                                               @if($data->status=='1') checked @endif>
                                                        <label for="readio1">
                                                            {{trans('app.active')}}
                                                        </label>
                                                    </div>
                                                    &nbsp; &nbsp;
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="readio2"
                                                               name="status"
                                                               value="0"   @if($data->status=='0') checked @endif>
                                                        <label for="readio2">
                                                            {{trans('app.inactive')}}
                                                        </label>
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

                        <div class="modal fade" id="deleteModal{{$key}}">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content text-center">
                                    <div class="modal-header btn-secondary">
                                        <h4 class="modal-title"></h4>
                                        <button type="button" class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                        </button>
                                    </div>
                                    {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['type.destroy',
                           $data->id]]) !!}
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete?</p>
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
                        </div>


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

                                                {!! Form::open(['method'=>'post','url'=>'roles/type']) !!}
                                                <div class="form-group">
                                                    <label for="inputName">{{trans('app.name')}}</label>
                                                    {!! Form::text('type_name',null,['class'=>'form-control','placeholder'=>'Enter User Type  Name','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('type_name', '<small class="text text-danger">:message</small>') !!}
                                                </div>
                                                <div class="form-group {{ ($errors->has('details'))?'has-error':'' }}">
                                                    <label for="inputDescription">{{trans('app.details')}}</label>
                                                    {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Enter User Type Description','rows'=>'4','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('details', '<span class="label label-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">{{trans('app.status')}} </label><br>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="readio3"
                                                               name="status" value="1"
                                                               checked>
                                                        <label for="readio3">
                                                            {{trans('app.active')}}
                                                        </label>
                                                    </div>
                                                    &nbsp; &nbsp;
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="readio4"
                                                               name="status"
                                                               value="0">
                                                        <label for="readio4">
                                                            {{trans('app.inactive')}}
                                                        </label>
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