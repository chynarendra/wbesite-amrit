<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Log in </title>
    <link rel="shortcut icon" href="">

    <!-- Google Font: Source Sans Pro -->
   {{-- <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('theme-design/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">

</head>
<body class="hold-transition login-page backgroundLogin">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4 class="loginSystem"><b>@if(isset(systemSetting()->app_name)){{systemSetting()->app_name}} @else {{ env('APP_NAME') }}  @endif</b></h4>
        </div>
        <div class="card-body">
            @if (\Route::current()->getName() == 'login')
                <p class="login-box-msg">@if(isset(systemSetting()->login_title)){{systemSetting()->login_title}} @endif </p>
            @elseif(\Route::current()->getName() == 'password.request')
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            @else
                <p class="login-box-msg">You are only one step a way from your new password, recover your password
                    now.
                </p>

        @endif

        @yield('content')
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('theme-design/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>
<script>
    $("document").ready(function () {
        setTimeout(function () {
            $("div.alert").remove();
        }, 5000); // 5 secs

    });
</script>
</body>
</html>
