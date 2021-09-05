<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | 404 Page not found</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('theme-design/css/adminlte.min.css')}}">
</head>
<body style="background: #CACFD2;">
<div class="wrapper" style="background: #CACFD2;">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background: #CACFD2;">

        <!-- Main content -->
        <section class="content" style="padding-top: 160px;">
            <div class="error-page">
                <h2 class="headline text-primary"> 404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-primary"></i> Oops! Page not found.</h3>

                    <p>
                        We could not find the page you were looking for.<br>
                        Meanwhile, you may <a href="{{url('/')}}">return to back</a>
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- ./wrapper -->
</body>
</html>


</div>
