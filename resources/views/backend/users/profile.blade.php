@extends('backend.layouts.app')
<title>@yield('page_title',trans('app.myProfile'))</title>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{trans('app.myProfile')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">{{trans('app.myProfile')}}</li>
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
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         @if($user->image!=null)
                                         src="{{asset('/storage/uploads/users/'.$user->image)}}"
                                         @else src="{{url('images/dummyUser.gif')}}" @endif
                                         alt="User profile picture">
                                </div>
                                <button type="button" class="btn btn-secondary btn-xs" style="margin: 10px 0 0 40px;"
                                        data-placement="top"
                                        data-toggle="modal" data-target="#profilePictureModal">
                                    <i class="fa fa-upload"> @if($user->image != null) Change Your Profile
                                        Photo @else Upload Profile Photo @endif
                                    </i>
                                </button>

                            </div>
                            <!-- Profile  Modal start -->
                            <div class="modal fade" id="profilePictureModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">  {{trans('app.profilePic')}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" data-toggle="tooltip"
                                                      title="Close">&times;</span>
                                            </button>
                                        </div>
                                        {!! Form::open(['method'=>'post','url'=>'/profile/profilePic','enctype'=>'multipart/form-data']) !!}
                                        <div class="modal-body">
                                            <div style="width: 450px; margin:10px 0 0 35px;">
                                                {{--set database image column name--}}
                                                <input type="hidden" name="column_name" value="image">
                                                {{--set file tile --}}
                                                <input type="hidden" name="file_title" value="{{$user->full_name}}">
                                                <label>{{trans('app.uploadImage')}}</label> <label
                                                        class="text-danger">*</label> <br>
                                                <input  name="update_file" type="file" required="">
                                                {{csrf_field()}}
                                                <br>
                                                @if($errors->has('upload_file') == null)
                                                    <span class="text text-danger"
                                                          style="font-size: 13px;color: #ff042c;">
                                                                        Upload type should be jpg,jpeg,png  & size less than 1 MB .
                                                                    </span>
                                                    @endif
                                                    {!! $errors->first('upload_file', '
                                                               <span class="badge badge-danger">
                                                                   :message
                                                               </span>
                                                               ') !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit"
                                                    class="btn btn-success">  {{trans('app.upload')}}</button>
                                            &nbsp; &nbsp;
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">  {{trans('app.aboutMe')}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-envelope"></i> {{trans('app.email')}}</strong>

                                <p class="text-muted">
                                    {{$user->email}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-user"></i> {{trans('app.userName')}}</strong>

                                <p class="text-muted">  {{$user->login_user_name}}</p>

                                <hr>
                                <strong>
                                    <i class="fa fa-sign-in-alt">
                                    </i>
                                    {{trans('app.lastLoggedIn')}}
                                </strong>
                                <p class="text-muted" style="float:right">
                                    <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($lastLogin))->
                                    diffForHumans() ?>
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#profile_setting"
                                                            data-toggle="tab">{{trans('app.profileSetting')}}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#account_setting"
                                                            data-toggle="tab">{{trans('app.accountSetting')}}</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile_setting">
                                        {!! Form::open(['method'=>'post','url'=>'profileUpdate']) !!}
                                        <input type="hidden" name="update_status" value="1">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label"> {{trans('app.fullName')}} <label
                                                        class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::text('full_name',Auth::user()->full_name,['class'=>'form-control','placeholder'=>'Enter Your  Name']) !!}

                                                {!! $errors->first('full_name', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                              ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                   class="col-sm-2 col-form-label"> {{trans('app.address')}}</label>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('address',Auth::user()->address,['class'=>'form-control','placeholder'=>'Enter User Type Description','rows'=>'2']) !!}

                                                {!! $errors->first('address', '
                                                             <span class="badge badge-danger">
                                                                 :message
                                                             </span>
                                                             ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label">  {{trans('app.phone')}}</label>
                                            <div class="col-sm-10">
                                                {!! Form::number('phone_number',Auth::user()->phone_number,['class'=>'form-control','placeholder'=>'Enter Your Phone Number','min'=>'10','max'=>'10']) !!}

                                                {!! $errors->first('phone_number', '
                                                          <span class="badge badge-danger">
                                                              :message
                                                          </span>
                                                          ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit"
                                                        class="btn btn-success"> {{trans('app.updateProfile')}}</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="account_setting">
                                        {!! Form::open(['method'=>'post','url'=>'profileUpdate']) !!}
                                        <input type="hidden" name="update_status" value="2">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label"> {{trans('app.loginUser')}}
                                                <label class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::text('login_user_name',Auth::user()->login_user_name,['class'=>'form-control','placeholder'=>'Enter Your Login Username','min'=>'3']) !!}

                                                {!! $errors->first('login_user_name', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                              ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label"> {{trans('app.loginEmail')}}
                                                <label class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::email('email',Auth::user()->email,['class'=>'form-control','placeholder'=>'Enter Your Email Address']) !!}

                                                {!! $errors->first('email', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                              ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit"
                                                        class="btn btn-success"> {{trans('app.updateProfile')}}</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                        {!! Form::open(['method'=>'post','url'=>'updatePassword']) !!}
                                        <input type="hidden" name="userId" value="{{$user->id}}">
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label">   {{trans('app.oldPassword')}}
                                                <label class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::password('old',array('placeholder'=>'Enter current password','class' => 'form-control','autocomplete'=>'off'));  !!}
                                                {!! $errors->first('old', '
                                                <span class="badge badge-danger">
                                                    :message
                                                </span>
                                                ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label">   {{trans('app.newPassword')}}
                                                <label class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::password('password',array('placeholder'=>'Enter new password','class' => 'form-control','autocomplete'=>'off'));  !!}
                                                @if($errors->has('password') == null)
                                                    <span style="color: #d22a16; font-size: 13px;">Password must be more than 8 characters long . Should contain at-least 1 Uppercase, 1 Lowercase 1 Numeric and 1 Special character</span>
                                                    &nbsp;<span style="font-size: 13px;">Example : Ab1$b3wG</span>
                                                @endif
                                                {!! $errors->first('password', '
                                                <span class="badge badge-danger">
                                                    :message
                                                </span>
                                                ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label">   {{trans('app.confirmPassword')}}
                                                <label class="text text-danger">
                                                    *
                                                </label></label>
                                            <div class="col-sm-10">
                                                {!! Form::password('password_confirmation',array('placeholder'=>'Enter new password again','class' => 'form-control','autocomplete'=>'off'));  !!}
                                                {!! $errors->first('password_confirmation', '
                                                  <span class="badge badge-danger">
                                                      :message
                                                  </span>
                                                  ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">updatePassword</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                            <!-- start modal start -->
                            <div class="modal fade" id="errorModal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <p>Are you sure you want to active?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
