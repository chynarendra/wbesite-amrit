@extends('backend.layouts.app')
<title>@yield('page_title',trans('app.appSetting'))</title>
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
                            <li class="breadcrumb-item">{{trans('app.appSetting')}}</li>
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
                                <h3 class="card-title">{{trans('app.appSetting')}}</h3>


                                <?php

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Go Back">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url($page_url)}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{trans('app.appName')}}</th>
                                        <th>{{trans('app.appLogo')}}</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$result['app_name']}}</td>
                                            <td>
                                                @if(isset($result['app_logo']))
                                                    <img src="{{asset('/storage/uploads/files/'.$result['app_logo'])}}" alt="Admin Logo" class="profile-user-img img-fluid img-circle"
                                                         style="opacity: .8">
                                                @else
                                                    Not Available
                                                @endif
                                                    <button type="button" class="btn btn-secondary btn-xs"
                                                            style="margin: 10px 0 0 10px;"
                                                            data-placement="top"
                                                            data-toggle="modal" data-target="#imageModal"  @if($result['app_logo'] != null) title="Change Logo"
                                                            @else title="Upload Logo" @endif>
                                                        <i class="fa fa-upload">
                                                        </i>
                                                    </button>
                                                    @if($result['app_logo'] != null)
                                                        <button type="button" class="btn btn-info btn-xs"
                                                                style="margin: 10px 0 0 10px;"
                                                                data-placement="top"
                                                                data-toggle="modal" data-target="#imageViewModal" title="View Logo">
                                                            <i class="fa fa-eye">
                                                            </i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-xs"
                                                                style="margin: 10px 0 0 10px;"
                                                                data-placement="top"
                                                                data-toggle="modal" data-target="#deleteFileModal" title="Delete Logo">
                                                            <i class="fa fa-trash">
                                                            </i>
                                                        </button>
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

                                <div class="modal fade" id="imageModal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content" style="width: 400px">
                                            <div class="modal-header btn-secondary">
                                                <h6 class="modal-title"><label>
                                                                        &nbsp; Change App Logo </label></h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                <span aria-hidden="true" data-toggle="tooltip"
                                                      title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['method'=>'post','url'=>$file_upload_url.'/'.$result['id'],'enctype'=>'multipart/form-data']) !!}
                                                <div class="form-group">
                                                    <input type="hidden" name="column_name" value="app_logo">
                                                    {{--set file tile --}}
                                                    <input type="hidden" name="file_title" value="{{$result['app_name']}}">
                                                    <label>{{trans('app.appLogo')}}</label> <label
                                                            class="text-danger">*</label> <br>
                                                    <input type="file" name="update_file" required>
                                                    <br>
                                                    @if($errors->has('app_logo') == null)
                                                        <span class="text text-danger"
                                                              style="font-size: 13px;color: #ff042c;">
                                                                        Upload type should be jpg,jpeg,png
                                                                        & size must be 1 MB .
                                                                    </span>
                                                        @endif
                                                        {!! $errors->first('app_logo', '<span class="badge badge-danger">
                                                                       :message
                                                                   </span>
                                                                   ') !!}
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="submit"
                                                        class="btn btn-success">  {{trans('app.upload')}}</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="imageViewModal">
                                    <div class="modal-dialog modal-sm  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header btn-secondary">
                                                <h6 class="modal-title"><label>
                                                                        &nbsp; Uploaded App Logo </label></h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                <span aria-hidden="true" data-toggle="tooltip"
                                                      title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body  text-center">
                                                <img src="{{asset('/storage/uploads/files/'.$result['app_logo'])}}"
                                                     width="100" height="100">
                                                <div class="modal-footer" style="text-align: center">
                                                    <a href="{{URL::to('storage/uploads/files/'.$result['app_logo'])}}"

                                                       class="btn btn-danger" download
                                                       data-toggle="tooltip"
                                                       title="Download File"><i
                                                                class="fa fa-download"></i>
                                                        Download

                                                    </a>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <button type="button"
                                                            class="btn btn-default"
                                                            data-dismiss="modal"
                                                            data-toggle="tooltip"
                                                            title="Close">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="deleteFileModal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header btn-secondary">
                                                <h4 class="modal-title"></h4>
                                                <button type="button" class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::model($result,['method'=>'DELETE','route'=>[$page_route.'.'.'destroy',$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="app_logo">
                                                <p>Are you sure you want to
                                                    delete logo?</p>
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

                                <div class="modal fade" id="editModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #6c757d">
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
                                                        {!! Form::model($result,['method'=>'PUT','route'=>[$page_route.'.'.'update',$result['id']],'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                                                        <div class="form-group">
                                                            <label for="inputName">{{trans('app.appName')}}</label>
                                                            {!! Form::text('app_name',null,['class'=>'form-control','placeholder'=>'Enter App    Name','autocomplete'=>'off']) !!}
                                                            {!! $errors->first('app_name', '<small class="text text-danger">:message</small>') !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">{{trans('app.appLogo')}}</label>
                                                            <input type="file" class="form-control-file" name="app_logo">
                                                            {!! $errors->first('app_logo', '<span class="text text-danger">:message</span>') !!}

                                                            @if($errors->has('app_logo') == null)
                                                                <span class="text text-danger"
                                                                      style="font-size: 12px;color: #ff042c">
                                                      Note: Upload type should be jpg,jpeg,png  & size less than 1 MB .
                                                 </span>
                                                            @endif
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