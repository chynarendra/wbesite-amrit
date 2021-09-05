    @extends('layouts.app')

    @section('content')

        @if (Session::has('status'))
            <div class="alert alert-success">
                <i class="fa fa-check" aria-hidden="true"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('status') }}
            </div>
        @endif

        {!! Form::open(['method'=>'post','route'=>'password.email','autocomplete'=>'off']) !!}
        <div class="input-group mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Your Email Address','autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        @if ($errors->has('email'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('email') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
        </div>
        {!! Form::close() !!}
        <p class="mt-3 mb-1">
            <a href="{{ route('login') }}">Return To Login</a>
        </p>

    @endsection
