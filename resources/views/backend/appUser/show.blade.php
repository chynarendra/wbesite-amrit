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
                        <h1 class="m-0">{{$data['page_title']}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{$data['page_title']}}</a></li>
                            <li class="breadcrumb-item">{{trans('User Detail')}}</li>
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
                                <h3 class="card-title">{{trans('Detail')}}</h3>
                                <?php
                                $permission = helperPermissionLink(url($data['page_url']), url($data['page_url']));
                                $allowEdit = $permission['isEdit'];
                                $allowDelete = $permission['isDelete'];
                                $allowAdd = $permission['isAdd'];
                                $allowShow = $permission['isShow'];
                                ?>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td>Name : {{$data['details']->full_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email : {{$data['details']->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile : {{$data['details']->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td>Office : {{$data['details']->office->office_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Designation : {{$data['details']->designation->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Register Date : {{$data['details']->register_date}}</td>
                                    </tr>

                                    <tr>
                                        <td>Status :
                                            @if($data['details']->status == '1')
                                                <a href="{{url('/appUser/approve/'.$data['details']->id)}}"
                                                   class="btn btn-success btn-xs">{{'Approved'}}</a>
                                            @else
                                                <a href="{{url('/appUser/approve/'.$data['details']->id)}}"
                                                   class="btn btn-danger btn-xs">{{'Unapproved'}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Approved By:
                                            @if($data['details']->approved_by!=null)
                                                {{$data['details']->approvedBy->full_name}}
                                            @endif

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Approved Date: {{$data['details']->approved_date}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
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
