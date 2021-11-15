@extends('backend.layouts.app')
<title>@yield('page_title',$data['page_title'])</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'App User Leaves / Holidays'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{'App User Leaves / Holidays'}}</a></li>
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
                                <h3 class="card-title">{{trans('app.list')}}</h3>
                                <?php
                                $permission = helperPermissionLink(url('appUser/leaves/'.$id), url('appUser/leaves/'.$id));
                                $allowEdit = $permission['isEdit'];
                                $allowDelete = $permission['isDelete'];
                                $allowAdd = $permission['isAdd'];
                                $allowShow = $permission['isShow'];
                                ?>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">{{trans('app.sn')}}</th>
                                        <th>Month Start Date</th>
                                        <th>Month End Date</th>
                                        <th>Holiday</th>
                                        <th>Leave</th>
                                        <th style="width: 160px">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leaves as $key=>$leave)
                                        <tr>
                                            <th scope=row>{{$key++}}</th>
                                            <td>{{$leave->month_start_date}}</td>
                                            <td>{{$leave->month_end_date}}</td>
                                            <td>{{$leave->holiday}}</td>
                                            <td>{{$leave->leave}}</td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right">{{ $data['results']->appends(request()->except('page'))->links() }}
                                </span>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
