@extends('backend.layouts.app')
<title>@yield('page_title','Information Dispatch (General)')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'Information Dispatch (General)'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('/general/info')}}">{{'Information Dispatch (General)'}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.list')}}</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="text-align:right">
                                <h3 class="card-title">Information Dispatch General</h3>

                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('report/general/dispatch')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <table id="example2"
                                           class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th colspan="3">Dispatch</th>
                                            <th>Ref. No.</th>
                                            <th>Issued To</th>
                                            <th>Address</th>
                                            <th>Subject</th>
                                            <th>User</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Method</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- Add Modal Start -->
                        <!-- /.row -->
                        <!-- /.container-fluid -->
                        <!-- /.content -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
