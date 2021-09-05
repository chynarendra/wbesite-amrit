@extends('backend.layouts.app')
<title>@yield('page_title',trans('app.myActivity'))</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(isset($user))
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> @if(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                               != $id )
                                    <strong class="btn btn-xs btn-primary"> @if(isset($user->full_name)) {{$user->full_name}} @endif</strong>
                                    &nbsp; {{trans('User Activity')}}
                                @elseif(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                                       == $id )
                                    {{trans('app.myActivity')}}
                                @else
                                    {{trans('app.myActivity')}}

                                @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            @if(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                      != $id )
                                <li class="breadcrumb-item">{{trans('User Activity')}}</li>
                            @elseif(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                                 == $id )
                                <li class="breadcrumb-item">{{trans('app.myActivity')}}</li>
                            @else
                                <li class="breadcrumb-item">{{trans('app.myActivity')}}}</li>
                            @endif
                            <li class="breadcrumb-item">{{trans('app.list')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="text-align:center">
                                <h3 class="card-title">{{trans('app.search')}}</h3>
                                <strong> Total Activity : </strong> <strong
                                        style="font-size: 16px; color: #FF0000;"> {{sizeof($userActivity)}}</strong>
                                <a href="{{URL::previous()}}" class="float-right" data-toggle="tooltip"
                                   title="Go Back">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive p-0" width="100%">
                                        <form
                                                @if(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                              != $id )
                                                action="{{url('user-activity/'.$user->id)}}" @elseif(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                                                       == $id )  action="{{url('/my-activity')}}"
                                                @else  action="{{url('/my-activity')}}" @endif autocomplete="off">

                                            <tr>
                                                <td>
                                                    {{Form::select('module_name',$moduleNames->pluck('menu_name','id'),Request::get('module_name'),['class'=>'form-control select2','id'=>'actionUser','style'=>'width: 100%;','placeholder'=>
                                                                    'Select Module Name'])}}
                                                </td>

                                                <td>
                                                    {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'from_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                       trans('app.fromDate'),'readonly']) !!}
                                                </td>

                                                <td>
                                                    {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'to_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                        =>
                                                                       trans('app.toDate'),'readonly']) !!}
                                                </td>
                                                <td>

                                                    <button type="submit" class="btn btn-primary"><i
                                                                class="fa fa-search"></i> {{trans('app.filter')}}
                                                    </button> &nbsp; &nbsp;

                                                    <a
                                                            @if(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                    != $id )
                                                            href="{{url('user-activity/'.$user->id)}}"
                                                            @elseif(Auth::user()->user_type_id == 1 &&  Auth::user()->id
                                                                                                   == $id )
                                                            href="{{url('/my-activity')}}"
                                                            @else
                                                            href="{{url('/my-activity')}}"
                                                            @endif
                                                            class="btn btn-default"> <i
                                                                class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                    </a>
                                                </td>

                                            </tr>
                                        </form>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                            <div class="card">
                                <div class="card-body">
                                    <ul class="products-list">
                                        @include('backend.users.user-activity')

                                    </ul>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                    </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        @else
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>@if(getAppSetting()){{getAppSetting()->app_name}} @else {{ env('APP_NAME') }}  @endif| 404 Page not found</title>

                <!-- Google Font: Source Sans Pro -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                            <h2 class="headline text-warning"> 404</h2>

                            <div class="error-content">
                                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                                <p>
                                    We could not find the page you were looking for.<br>
                                    Meanwhile, you may <a href="{{URL::previous()}}">return to back</a>
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


    @endif
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection