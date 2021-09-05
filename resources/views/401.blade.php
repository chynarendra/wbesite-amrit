@extends('backend.layouts.app')
<title>@yield('page_title',trans('Permission Denied'))</title>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <center><div class="error-page">
                    <h2 class="text-red" style="font-size: 50px;"> 401</h2>
                </div>

                <div class="error-content">
                    <h3 class="text-red"><i class="fa fa-warning"></i> SORRY </h3>
                    <p style="font-size: 20px;">
                       You do not have permission<br>
                        Please contact your administrator ! <br> <br>
                        <a  class="btn btn-danger" href="{{URL::previous()}}"> <i class="fa fa-arrow-left"> </i> Go Back</a>
                    </p>
                </div>
                <div>
                </div>
            </center>
        </section>
    </div>
@endsection
