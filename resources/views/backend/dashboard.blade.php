@extends('backend.layouts.app')
<script src="{{url('plugins/chart/highcharts.js')}}"></script>
<script src="{{url('plugins/chart/export-data.js')}}"></script>
<script src="{{url('plugins/chart/exporting.js')}}"></script>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$page_title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">{{$page_title}}</li>
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
                    @if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total User</span>
                                <span class="info-box-number">
                               {{$total_user}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    @endif

                    <!-- ./col -->
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection