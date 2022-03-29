@extends('backend.layouts.app')
<title>@yield('page_title','General Dispatch')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'General Dispatch'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('/general/dispatch')}}">{{'General Dispatch'}}</a></li>
                            <li class="breadcrumb-item">General Dispatch</li>
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
                                <h3 class="card-title"><strong>General Dispatch {{trans('app.details')}}</strong></h3>
                                <?php
                                $permission = helperPermission();
                                $allowEdit = $permission['isEdit'];
                                $allowDelete = $permission['isDelete'];
                                $allowAdd = $permission['isAdd'];
                                ?>

                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/general/dispatch')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="{{url('/general/dispatch/create')}}" class="pull-right" title="Add New"><i
                                                class="fa fa-plus-circle fa-2x"></i></a>
                                @endif
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- Add Modal Start -->
                        <!-- /.row -->
                        <!-- /.container-fluid -->
                        <!-- /.content -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"><strong>About</strong></h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="fas fa-calendar-alt mr-1"></i> Fiscal Year : {{$data->FISCAL_YR}}
                                </strong>
                                <hr/>
                                <strong><i class="fas fa-file-alt mr-1"></i> Ref.No. : {{$data->REF_NO}}</strong>
                                <hr />

                                <strong><i class="fas fa-cogs mr-1"></i> Dispatch Method : {{$data->DISPATCH_METHOD}}</strong><br/>
                                <strong><i class="fas fa-file-alt mr-1"></i> Dispatch No. : {{$data->DISPATCH_NO}}</strong>
                                <p class="text-muted">
                                    <span>Dispatch Date : </span><br/>
                                    <span>B.S. : {{$data->DISPATCH_DT_NEP}}</span><br/>
                                    <span>A.D. : {{$data->DISPATCH_DT_ENG}}</span><br/>
                                </p>
                                <hr>

                                <strong><i class="far fa-user mr-1"></i> Issued To</strong>
                                <p class="text-muted">{{$data->ISSUED_TO}}</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-9">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"><strong>Details</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="post">
                                        <p>Address : {{$data->ADDRESS}}</p>
                                        <p>Subject : {{$data->SUBJECT}}</p>
                                        <p>Remarks : {{$data->REMARKS}}</p>
                                        <hr/>
                                        <span>Entered By : {{$data->ENTERED_BY}}</span>
                                        <div class="pull-right">
                                            <span>Entered Date :</span>
                                            <span style="margin-left: 10px;">B.S. : {{$data->ENTERED_DT_NEP}}</span>
                                            <span style="margin-left: 20px;">A.D. : {{$data->ENTERED_DT_ENG}}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
