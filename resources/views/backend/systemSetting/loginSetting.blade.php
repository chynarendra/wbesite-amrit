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
                        <h1 class="m-0">{{trans('app.systemSetting')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{trans('app.systemSetting')}}</a></li>
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
                                <h3 class="card-title">{{$page_title}}</h3>


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
                                        <th>{{trans('app.loginTitle')}}</th>
                                        <th>{{trans('app.loginCaptcha')}}</th>
                                        <th>{{trans('app.loginForgetPassword')}}</th>
                                        <th>{{trans('app.loginAttemptLimit')}}</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if(isset($result['login_title']))
                                                    {{$result['login_title']}}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($result['login_captcha_required'] == '1')
                                                    <button type="button"
                                                            class="btn btn-success btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#captchaModal"
                                                            title="Click here update  status">
                                                        {{trans('app.yes')}}
                                                    </button>
                                                @elseif($result['login_captcha_required']== '0')
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#captchaModal"
                                                            title="Click here update  status">
                                                        {{trans('app.no')}}
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($result['forget_password_required'] == '1')
                                                    <button type="button"
                                                            class="btn btn-success btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#forgetPasswordModal"
                                                            title="Click here update  status">
                                                        {{trans('app.yes')}}
                                                    </button>
                                                @elseif($result['forget_password_required']== '0')
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#forgetPasswordModal"
                                                            title="Click here update  status">
                                                        {{trans('app.no')}}
                                                    </button>
                                                @endif
                                            </td>

                                            <td>
                                                @if(isset($result['login_attempt_limit']))
                                                    {{$result['login_attempt_limit']}}
                                                    <button type="button" class="btn btn-success btn-xs"
                                                            style="margin: 10px 0 0 10px;"
                                                            data-placement="top"
                                                            data-toggle="modal" data-target="#loginAttemptModal"> Update
                                                    </button>
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

                                <div class="modal fade" id="captchaModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="login_captcha_required">
                                                @if($result['login_captcha_required'] == 1)
                                                    <input type="hidden" name="status" value="0">
                                                    <h6>Are you sure you want to
                                                        no ?</h6>
                                                @else
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Are you sure you want to yes ?</h6>
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
                                    </div>
                                </div>

                                <div class="modal fade" id="forgetPasswordModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="forget_password_required">
                                                @if($result['forget_password_required'] == 1)
                                                    <input type="hidden" name="status" value="0">
                                                    <h6>Are you sure you want to
                                                        no ?</h6>
                                                @else
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Are you sure you want to yes ?</h6>
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
                                </div>

                                <div class="modal fade" id="registerModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="register_required">
                                                @if($result['register_required ']== 1)
                                                    <input type="hidden" name="status" value="0">
                                                    <h6>Are you sure you want to
                                                        no?</h6>
                                                @else
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Are you sure you want to yes?</h6>
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

                                <div class="modal fade" id="loginAttemptModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body">
                                                <input type="hidden" name="column_name" value="login_attempt_limit">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>{{trans('app.loginAttemptLimit')}}</label> <label
                                                                class="text text-danger"> *</label>
                                                        <input type="number" class="form-control" name="status" value="{{$result['login_attempt_limit']}}" required min="1">
                                                        {!! $errors->first('login_attempt_limit', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="submit"
                                                        class="btn btn-success">{{trans('app.update')}}
                                                </button> &nbsp; &nbsp;
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="imageModal">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content" style="width: 400px">
                                            <div class="modal-header btn-secondary">
                                                <h6 class="modal-title"><label> Change Login Background  Image </label>
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                <span aria-hidden="true" data-toggle="tooltip"
                                                      title="Close">&times;</span>
                                                </button>
                                            </div>
                                            {!! Form::open(['method'=>'post','url'=>$file_upload_url.'/'.$result['id'],'enctype'=>'multipart/form-data']) !!}
                                            <div class="modal-body">
                                                <div style="width: 450px; margin:10px 0 0 35px;">
                                                    <input type="hidden" name="column_name" value="login_background_image">
                                                    <input type="hidden" name="file_title" value="{{$result['login_title']}}">
                                                    <label>{{trans('app.uploadImage')}}</label> <label
                                                            class="text-danger">*</label> <br>
                                                    <input type="file" name="update_file" required>
                                                    <br>
                                                    @if($errors->has('update_file') == null)
                                                        <span class="text text-danger"
                                                              style="font-size: 13px;color: #ff042c;">
                                                                        Upload type should be jpg,jpeg,png
                                                                        & size must be 1 MB .
                                                                    </span>
                                                    @endif
                                                    {!! $errors->first('update_file', '
                                                               <span class="badge badge-danger">
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
                                    </div>
                                </div>

                                <div class="modal fade" id="imageViewModal">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content" style="width: 500px">
                                            <div class="modal-header btn-secondary">
                                                <h6 class="modal-title">
                                                    <label> Uploaded Login Background  Image </label>
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                <span aria-hidden="true" data-toggle="tooltip"
                                                      title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{asset('/storage/uploads/files/'.$result['login_background_image'])}}"
                                                        width="470"   height="350">

                                                </iframe>
                                                <div style="text-align: center">
                                                    <hr>
                                                    <a href="{{URL::to('storage/uploads/files/'.$result['login_background_image'])}}"

                                                       class="btn  btn-danger" download
                                                       data-toggle="tooltip"
                                                       title="Download File"><i
                                                                class="fa fa-download"></i>
                                                        Download

                                                    </a>
                                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                                    <button type="button"
                                                            class="btn   btn-default"
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
                                            <div class="modal-body">
                                                <input type="hidden" name="column_name" value="login_background_image">
                                                <p>Are you sure you want to
                                                    delete image?</p>
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
                                            <div class="modal-header btn-secondary">
                                                <h4 class="modal-title">{{trans('app.edit')}}</h4>
                                                <button type="button" class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::model($result,['method'=>'PUT','route'=>[$page_route.'.'.'update',$result['id']],'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>{{trans('app.loginTitle')}}</label> <label
                                                                class="text text-danger"> *</label>
                                                        {!! Form::text('login_title',null,['class'=>'form-control','required','min'=>'1']) !!}
                                                        {!! $errors->first('login_title', '<span class="text text-danger">:message</span>') !!}
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="status">{{trans('app.loginCaptcha')}} </label><br>
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" id="readio1"
                                                                   name="login_captcha_required" value="1"   @if($result['login_captcha_required']=='1') checked @endif>
                                                            <label for="readio1">
                                                                {{trans('app.yes')}}
                                                            </label>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" id="readio2"
                                                                   name="login_captcha_required"
                                                                   value="0"  @if($result['login_captcha_required']=='0') checked @endif>
                                                            <label for="readio2">
                                                                {{trans('app.no')}}
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="status">{{trans('app.loginForgetPassword')}} </label><br>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="readio3"
                                                                   name="forget_password_required" value="1"  @if($result['forget_password_required']=='1') checked @endif>
                                                            <label for="readio3">
                                                                {{trans('app.yes')}}
                                                            </label>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="readio4"
                                                                   name="forget_password_required"
                                                                   value="0" @if($result['forget_password_required']=='0') checked @endif>
                                                            <label for="readio4">
                                                                {{trans('app.no')}}
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="status">{{trans('app.loginRegister')}} </label><br>
                                                        <div class="icheck-info d-inline">
                                                            <input type="radio" id="readio5"
                                                                   name="register_required" value="1"  @if($result['register_required']=='1') checked @endif>
                                                            <label for="readio5">
                                                                {{trans('app.yes')}}
                                                            </label>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <div class="icheck-info d-inline">
                                                            <input type="radio" id="readio6"
                                                                   name="register_required"
                                                                   value="0" @if($result['register_required']=='0') checked @endif>
                                                            <label for="readio6">
                                                                {{trans('app.no')}}
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{trans('app.loginAttemptLimit')}}</label> <label
                                                                class="text text-danger"> *</label>

                                                        {!! Form::number('login_attempt_limit',null,['class'=>'form-control','required','min'=>'1']) !!}
                                                        {!! $errors->first('login_attempt_limit', '<span class="text text-danger">:message</span>') !!}
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="image">{{trans('app.loginBackgroundImage')}}</label>
                                                        <input type="file" class="form-control-file" name="login_background_image">
                                                        {!! $errors->first('login_background_image', '<span class="text text-danger">:message</span>') !!}

                                                        @if($errors->has('login_background_image') == null)
                                                            <span class="text text-danger"
                                                                  style="font-size: 12px;color: #ff042c">
                                                      Note: Upload type should be jpg,jpeg,png  & size less than 1 MB .
                                                 </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="status">{{trans('app.loginBackgroundImageDisplay')}} </label><br>
                                                        <div class="icheck-info d-inline">
                                                            <input type="radio" id="readio7"
                                                                   name="login_background_image_display" value="1"  @if($result['login_background_image_display']=='1') checked @endif>
                                                            <label for="readio7">
                                                                {{trans('app.yes')}}
                                                            </label>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <div class="icheck-info d-inline">
                                                            <input type="radio" id="readio8"
                                                                   name="login_background_image_display"
                                                                   value="0" @if($result['login_background_image_display']=='0') checked @endif>
                                                            <label for="readio8">
                                                                {{trans('app.no')}}
                                                            </label>
                                                        </div>

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

                                <div class="modal fade" id="imageDisplayModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="login_background_image_display">
                                                @if($result['login_background_image_display'] == 1)
                                                    <input type="hidden" name="status" value="0">
                                                    <h6>Are you sure you want to
                                                        hide image ?</h6>
                                                @else
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Are you sure you want to display image?</h6>
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
                                    </div>
                                </div>

                                <div class="modal fade" id="imageDisplayConditionModal">
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
                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]]) !!}
                                            <div class="modal-body text-center">
                                                <input type="hidden" name="column_name" value="background_image_display_condition">
                                                @if($result['background_image_display_condition'] == 0)
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Are you sure you want to display both (Login & Register)</h6>
                                                @elseif($result['background_image_display_condition'] == 2)
                                                    <input type="hidden" name="status" value="1">
                                                    <h6>Register  background image already used.
                                                        Are you sure you want to display both (Login & Register) ?
                                                    </h6>
                                                @else
                                                    <input type="hidden" name="status" value="0">
                                                    <h6>Are you sure you want to hide both (Login & Register)
                                                    </h6>
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
                                    </div>
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