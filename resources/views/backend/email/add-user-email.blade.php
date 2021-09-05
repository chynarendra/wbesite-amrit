<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration Information</title>
</head>

<body style="width: 100%; border: 3px solid #cccccc">
<br>
<div class="container" style="margin-left:30px;  text-align: center;">

    <h3>Congratulations!</h3>
    <p>Dear ,
        <strong>{{$fullName}}</strong>
    <p>
    <p class="lead">Your Profile has been successfully created. <br>
        Please protect your login information. <br>
        Don't share with anyone.
    </p>
    <p class="callout">
        {{trans('Login User Name')}} : <strong>{{$userName}}</strong><br>
        {{trans('Login Email Address')}} : <strong>{{$email}}</strong><br>
        {{trans('Password')}} : <strong>{{$password}}</strong>
    <p>Please click <a href="{{url('/login')}}" data-toggle="tooltip" data-placement="top"
                       title="Click for Login">Here</a>
    </p>
    <br/>
    <div class="col-md-12">

        <div>
            <hr style="width: 100%;">
            <br> Powered by: <a href="{{url('/dashboard')}}" style="color:#337ab7; margin-bottom: 10px;">Laravel 5.7</a>
        </div>
    </div>

</div>
</body>
</html>
