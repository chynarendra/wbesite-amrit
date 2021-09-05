@extends('backend.layouts.app')
<title>@yield('page_title','Users')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Users'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('users')}}">{{'Users'}}</a></li>
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

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];

                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/users')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="" class="pull-right" data-toggle="modal"
                                       data-target="#addModal"
                                       title="Add New">
                                        <i class="fa fa-plus-circle fa-2x"></i></a>
                                @endif


                            </div>
                        </div>
                        <!-- /.card-header -->
                            <div class="card">
                                <div class="card-body">
                                    <table id="example2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="10px">{{trans('app.sn')}}</th>
                                            <th>{{trans('app.fullName')}} </th>
                                            <th>{{trans('Designation')}} </th>
                                            <th>{{trans('app.email')}} / {{trans('app.phone')}}</th>
                                            <th>{{trans('app.status')}}</th>
                                            <th>{{trans('app.blockStatus')}}</th>
                                            <th style="width: 70px;"
                                                class="text-right">{{trans('app.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $results=$data['results'];
                                                $page_url=$data['page_url'];
                                                $page_route=$data['page_route'];
                                                $typeList=$data['typeList'];
                                                $officeList=$data['officeList'];
                                                $designationList=$data['designationList'];
                                            ?>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                                <td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $data->id)
                                                        <button class="btn btn-secondary btn-xs">You</button>
                                                    @else
                                                        {{$data->full_name}}
                                                        @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->designation->name))
                                                       {{ $data->designation->name}}
                                                        @endif
                                                </td>

                                                <td>
                                                    {{$data->email}}
                                                    @if(isset($data->phone_number))
                                                        <br>
                                                        {{$data->phone_number}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($data->id != \Illuminate\Support\Facades\Auth::user()->id)
                                                        @if($data->status == '1')
                                                            <button type="button"
                                                                    class="btn btn-success btn-xs"
                                                                    data-toggle="modal"
                                                                    data-target="#statusModal{{$key}}"
                                                                    title="Click here update  status">
                                                                {{trans('app.active')}}
                                                            </button>
                                                        @elseif($data->status== '0')
                                                            <button type="button"
                                                                    class="btn btn-danger btn-xs"
                                                                    data-toggle="modal"
                                                                    data-target="#statusModal{{$key}}"
                                                                    title="Click here update  status">
                                                                {{trans('app.inactive')}}
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($data->id != \Illuminate\Support\Facades\Auth::user()->id)

                                                        @if($data->block_status == true)
                                                            <button type="button"
                                                                    class="btn btn-danger btn-xs"
                                                                    data-toggle="modal"
                                                                    data-target="#blockStatusModal{{$key}}"
                                                                    title="Click here update  status">
                                                                {{trans('app.yes')}}
                                                            </button>

                                                        @elseif($data->block_status== false)

                                                            <strong
                                                                    class="btn btn-secondary btn-xs"> {{trans('app.no')}}
                                                            </strong>
                                                        @endif
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
                                                    &nbsp;

                                                    @if($data->id != \Illuminate\Support\Facades\Auth::user()->id)
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{$key}}"
                                                                data-placement="top" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>

                                            @include('backend.modal.status_modal')
                                            @include('backend.modal.delete_modal')
                                            <div class="modal fade" id="blockStatusModal{{$key}}">
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
                                                        {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['users/block_status/'.$data->id]]) !!}
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to unblock?</p>

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




                                            <div class="modal fade" id="editModal{{$key}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width: 600px;">
                                                        <div class="modal-header"
                                                             style="background: #6c757d">
                                                            <h4 class="modal-title">{{trans('app.edit')}}</h4>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::model($data,['method'=>'PUT','route'=>['users.update',$data->id],'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                                                            <div class="row">
                                                                <div class="form-group col-md-6 {{ ($errors->has('user_type_id'))?'has-error':'' }}">
                                                                    <label>{{trans('app.userType')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>
                                                                    {{Form::select('user_type_id',$typeList->pluck('type_name','id'),Request::get('user_type_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                'Select User Type'])}}

                                                                    {!! $errors->first('user_type_id', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('office_id'))?'has-error':'' }}">
                                                                    <label>{{trans('Office')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>
                                                                    {{Form::select('office_id',$officeList->pluck('office_name','id'),Request::get('office_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                'Select Office'])}}

                                                                    {!! $errors->first('office_id', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('designation_id'))?'has-error':'' }}">
                                                                    <label>{{trans('Designation')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>
                                                                    {{Form::select('designation_id',$designationList->pluck('name','id'),Request::get('designation_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                'Select Designation'])}}

                                                                    {!! $errors->first('designation_id', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6  {{ ($errors->has('full_name'))?'has-error':'' }}">
                                                                    <label>{{trans('app.fullName')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>

                                                                    {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Full Name']) !!}
                                                                    {!! $errors->first('full_name', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('login_user_name'))?'has-error':'' }}">
                                                                    <label>{{trans('app.loginUser')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>

                                                                    {!! Form::text('login_user_name',null,['class'=>'form-control','placeholder'=>'Login User Name']) !!}
                                                                    {!! $errors->first('login_user_name', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('email'))?'has-error':'' }}">
                                                                    <label>{{trans('app.loginEmail')}}</label>
                                                                    <label
                                                                            class="text text-danger">
                                                                        *</label>

                                                                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Email Address']) !!}
                                                                    {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                                                                </div>

                                                                @if(\Illuminate\Support\Facades\Auth::user()->id != $data->id)
                                                                    <div class="form-group col-md-6">
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
                                                                @endif
                                                                <div class="form-group col-md-6">
                                                                    <label for="status">{{trans('app.changePassword')}} </label><br>
                                                                    <input class="radio-button" type="radio"
                                                                           name="change_password"
                                                                           onclick="changePasswordYes();" value="1"
                                                                           style="margin-top: 2px"> {{trans('app.yes')}}
                                                                    &nbsp; &nbsp;
                                                                    <input class="radio-button" type="radio"
                                                                           name="change_password"
                                                                           onclick="changePasswordNo()" value="0"
                                                                           style="margin-top: 2px"
                                                                           checked> {{trans('app.no')}}


                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('email'))?'has-error':'' }}" id="updatePasswordBlock" style="display: none">
                                                                    <label>{{trans('app.password')}}</label> <label
                                                                            class="text text-danger"> *</label>

                                                                    {!! Form::password('password',array('placeholder'=>'Password','class' => 'form-control'));  !!}

                                                                    {!! $errors->first('password', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('confirm_password'))?'has-error':'' }}" id="updateConfirmPasswordBlock" style="display: none">
                                                                    <label>{{trans('app.confirmPassword')}}</label>
                                                                    <label
                                                                            class="text text-danger"> *</label>

                                                                    {!! Form::password('confirm_password',array('placeholder'=>'Confirm Password','class' => 'form-control'));  !!}

                                                                    {!! $errors->first('confirm_password', '<span class="text text-danger">:message</span>') !!}
                                                                </div>
                                                                <div class="form-group col-md-6 {{ ($errors->has('image'))?'has-error':'' }}">
                                                                    <label for="image">{{trans('app.userImage')}}</label>
                                                                    <input type="file"
                                                                           class="form-control-file"
                                                                           name="image">
                                                                    {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                                                                    @if($errors->has('image') == null)
                                                                        <span class="text text-danger"
                                                                              style="font-size: 12px;color: #ff042c">
                                                                                          Note: Upload type should be jpg,jpeg,png  & size less than 1 MB .
                                                                                     </span>
                                                                    @endif
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
                                                        <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span class="float-right">
                                        {{ $results->appends(request()->except('page'))->links() }}
                                    </span>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                    <!-- Add Modal Start -->

                        <div class="modal fade" id="addModal">
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

                                        {!! Form::open(['method'=>'post','url'=>'users','enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                                        <div class="row">
                                            <div class="form-group col-md-6 {{ ($errors->has('user_type_id'))?'has-error':'' }}">
                                                <label>{{trans('app.userType')}}</label> <label
                                                        class="text text-danger"> *</label>
                                                {{Form::select('user_type_id',$typeList->pluck('type_name','id'),Request::get('user_type_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                            'Select User Type'])}}

                                                {!! $errors->first('user_type_id', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('office_id'))?'has-error':'' }}">
                                                <label>{{trans('Office')}}</label>
                                                <label
                                                        class="text text-danger">
                                                    *</label>
                                                {{Form::select('office_id',$officeList->pluck('office_name','id'),Request::get('office_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                            'Select Office'])}}

                                                {!! $errors->first('office_id', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('designation_id'))?'has-error':'' }}">
                                                <label>{{trans('Designation')}}</label>
                                                <label
                                                        class="text text-danger">
                                                    *</label>
                                                {{Form::select('designation_id',$designationList->pluck('name','id'),Request::get('designation_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                            'Select Designation'])}}

                                                {!! $errors->first('designation_id', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6  {{ ($errors->has('full_name'))?'has-error':'' }}">
                                                <label>{{trans('app.fullName')}}</label> <label
                                                        class="text text-danger"> *</label>

                                                {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Full Name']) !!}
                                                {!! $errors->first('full_name', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('login_user_name'))?'has-error':'' }}">
                                                <label>{{trans('app.loginUser')}}</label> <label
                                                        class="text text-danger"> *</label>

                                                {!! Form::text('login_user_name',null,['class'=>'form-control','placeholder'=>'Login User Name']) !!}
                                                {!! $errors->first('login_user_name', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('email'))?'has-error':'' }}">
                                                <label>{{trans('app.loginEmail')}}</label> <label
                                                        class="text text-danger"> *</label>

                                                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Email Address']) !!}
                                                {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6">
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
                                            <div class="form-group col-md-6">
                                                <label for="status">{{trans('app.randPassword')}} </label><br>
                                                <input class="radio-button" type="radio" name="rand_password" checked=""
                                                       onclick="passwordYes();" value="1" style="margin-top: 2px"> {{trans('app.yes')}}
                                                &nbsp; &nbsp;
                                                <input class="radio-button" type="radio" name="rand_password"
                                                       onclick="passwordNo()" value="0" style="margin-top: 2px"> {{trans('app.no')}}


                                            </div>
                                                <div class="form-group col-md-6 {{ ($errors->has('email'))?'has-error':'' }}"  id="passwordBlock" style="display: none">
                                                    <label>{{trans('app.password')}}</label> <label
                                                            class="text text-danger"> *</label>

                                                    {!! Form::password('password',array('placeholder'=>'Password','class' => 'form-control'));  !!}

                                                    {!! $errors->first('password', '<span class="text text-danger">:message</span>') !!}
                                                </div>
                                                <div class="form-group col-md-6 {{ ($errors->has('confirm_password'))?'has-error':'' }}" id="confirmPasswordBlock" style="display: none">
                                                    <label>{{trans('app.confirmPassword')}}</label> <label
                                                            class="text text-danger"> *</label>

                                                    {!! Form::password('confirm_password',array('placeholder'=>'Confirm Password','class' => 'form-control'));  !!}

                                                    {!! $errors->first('confirm_password', '<span class="text text-danger">:message</span>') !!}
                                                </div>


                                            <div class="form-group col-md-6">
                                                <label for="status">{{trans('Send Email')}} </label><br>
                                                <input class="radio-button" type="radio" name="send_email" value="1"
                                                       style="margin-top: 2px"> {{trans('app.yes')}} &nbsp; &nbsp;
                                                <input class="radio-button" type="radio" name="send_email" value="0"
                                                       style="margin-top: 2px" checked> {{trans('app.no')}}


                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('image'))?'has-error':'' }}">

                                                <label for="image">{{trans('app.userImage')}}</label>
                                                <input type="file" class="form-control-file"
                                                       name="image">
                                                {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                                                @if($errors->has('image') == null)
                                                    <span class="text text-danger"
                                                          style="font-size: 11px;color: #ff042c"> Upload type should be jpg,jpeg,png  & size less than 1 MB .
                                                 </span>
                                                @endif
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

                            <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <script>
        function passwordYes() {
            $("#passwordBlock").hide();
            $("#confirmPasswordBlock").hide();
        }

        function passwordNo() {
            $("#passwordBlock").show();
            $("#confirmPasswordBlock").show();
        }

        function changePasswordYes() {
            $("#updatePasswordBlock").show();
            $("#updateConfirmPasswordBlock").show();
        }

        function changePasswordNo() {
            $("#updatePasswordBlock").hide();
            $("#updateConfirmPasswordBlock").hide();
        }
    </script>

@endsection
