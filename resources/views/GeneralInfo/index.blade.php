@extends('backend.layouts.app')
<title>@yield('page_title','General Information Registration')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'General Information Registration'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('/general/info')}}">{{'General Information Registration'}}</a></li>
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

                                $permission = helperPermission();

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];

                                ?>

                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/general/info')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="{{url('/general/info/create')}}" class="pull-right" title="Add New"><i class="fa fa-plus-circle fa-2x"></i></a>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Fiscal Year</th>
                                        <th>Reg. No.</th>
                                        <th>Reg Date</th>
                                        <th>Ref No</th>
                                        <th>Ref Date</th>
                                        <th>Issued By</th>
                                        <th>Address</th>
                                        <th style="width: 70px;"
                                            class="text-right">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($infos as $key=>$data)
                                        <tr>
                                            <th scope=row>{{ ($infos->currentpage()-1) * $infos->perpage() + $key+1 }}</th>
                                            <th>{{$data->FISCAL_YR}}</th>
                                            <th>{{$data->REG_NO}}</th>
                                            <th>{{$data->REG_DT_NEP}}</th>
                                            <th>{{$data->REF_NO}}</th>
                                            <th>{{$data->REF_DT_NEP}}</th>
                                            <th>{{$data->ISSUED_BY}}</th>
                                            <th>{{$data->ADDRESS}}</th>
                                            <td>
                                                <a href="{{url('general/info/'.$data->id)}}" class="btn btn-info btn-xs" title="Edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($allowEdit)
                                                    <a href="{{url('general/info/edit/'.$data->id)}}" class="btn btn-info btn-xs" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endif

                                                @if($allowDelete)
                                                    <button type="button" class="btn btn-danger btn-xs"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{$key}}"
                                                            data-placement="top" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @include('GeneralInfo.delete_modal')
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right">
                                        {{ $infos->appends(request()->except('page'))->links() }}
                                    </span>
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
