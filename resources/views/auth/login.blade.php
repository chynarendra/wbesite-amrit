@extends('layouts.app')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            <i class="fa fa-times" aria-hidden="true"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif

    @if ( $errors->has('login_user_name'))

        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $errors->first('email') }}
            {{ $errors->first('login_user_name') }}
        </div>
    @endif
    {!! Form::open(['method'=>'post','route'=>'login']) !!}

    <div class="input-group mb-3">
        {!! Form::text('identity',null,['class'=>'form-control','placeholder'=>'Username or Email Address','autocomplete'=>'off']) !!}
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
    </div>
    @if ($errors->has('identity'))
        <div class="input-group mb-3" style="margin-top: -13px;">
            <strong style="color: red">{{ $errors->first('identity') }}</strong>
        </div>
    @endif
    <div class="input-group mb-3">
        {!! Form::password('password',array('placeholder'=>'Password','class' => 'form-control','autocomplete'=>'off'));  !!}
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    @if ($errors->has('password'))
        <div class="input-group mb-3" style="margin-top: -13px;">
            <strong style="color: red">{{ $errors->first('password') }}</strong>
        </div>
    @endif
    @if(@systemSetting()->login_captcha_required == 1)
        <div class="form-group">
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-info" id="reload" data-toggle="tooltip" title="Refresh Captcha">
                    &#x21bb;
                </button>
            </div>
        </div>
        <div class="form-group {{ ($errors->has('captcha'))?'has-error':'' }}">
            <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"
                   autocomplete="off">
        </div>
        @if ($errors->has('captcha'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('captcha') }}</strong>
            </div>
        @endif
    @endif

    <div class="col-xs-12">
        <button type="submit" class="btn btn-info btn-block">Sign In</button>
    </div>
    {!! Form::close() !!}
    @if(@systemSetting()->forget_password_required == 1)
        <p class="mb-1">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
    @endif
@endsection
