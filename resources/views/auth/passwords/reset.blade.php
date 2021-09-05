@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control" name="email" value="{{ $email }}"
                   required autocomplete="off" placeholder="Enter Your Email Address">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-envelope"></span>
                </div>
            </div>
        </div>
        @if ($errors->has('email'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('email') }}</strong>
            </div>
        @endif

        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control" name="password"
                   required autocomplete="off" placeholder="Enter New Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            @if($errors->has('password') == null)
                <span style="color: #d22a16; font-size: 13px;">Password must be more than 8 characters long . Should contain at-least 1 Uppercase, 1 Lowercase 1 Numeric and 1 Special character</span>
                &nbsp;<span style="font-size: 13px;">Example : Ab1$b3wG</span>
            @endif
        </div>
        @if ($errors->has('password'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('password') }}</strong>
            </div>
        @endif

        <div class="input-group mb-3">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                   required autocomplete="off" placeholder="Enter New Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
        </div>
        @if ($errors->has('password_confirmation'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('password_confirmation') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-info btn-block">Change password</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Return To Login</a>
    </p>
@endsection