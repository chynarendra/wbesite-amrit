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
                                <a href="{{url('/general/dispatch')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>
                                @if($allowAdd)
                                    <a href="{{url('/general/dispatch/create')}}" class="pull-right" title="Add New"><i class="fa fa-plus-circle fa-2x"></i></a>
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
                                        <th>Ref No</th>
                                        <th>Dispatch Method</th>
                                        <th>Dispatch No.</th>
                                        <th>Dispatch Date</th>
                                        <th>Issue To</th>
                                        <th style="width: 70px;"
                                            class="text-right">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($generalDispatches as $key=>$data)
                                        <tr>
                                            <th scope=row>{{ ($generalDispatches->currentpage()-1) * $generalDispatches->perpage() + $key+1 }}</th>
                                            <th>{{$data->FISCAL_YR}}</th>
                                            <th>{{$data->REF_NO}}</th>
                                            <th>{{$data->DISPATCH_METHOD}}</th>
                                            <th>{{$data->DISPATCH_NO}}</th>
                                            <th>{{$data->DISPATCH_DT_NEP}}</th>
                                            <th>{{$data->ISSUED_TO}}</th>
                                            <td>
                                                <a href="{{url('/general/dispatch/'.$data->id)}}" class="btn btn-info btn-xs" title="Edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($allowEdit)
                                                    <a href="{{url('/general/dispatch/edit/'.$data->id)}}" class="btn btn-info btn-xs" title="Edit">
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
                                                    @include('GeneralDispatch.delete_modal')
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right">
                                        {{ $generalDispatches->appends(request()->except('page'))->links() }}
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
