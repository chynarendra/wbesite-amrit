@extends('backend.layouts.app')
<title>@yield('page_title',$page_title)</title>
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{trans('Setting')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{trans('Setting')}}</a></li>
                        <li class="breadcrumb-item">{{$page_title}}</li>
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
                            <h3 class="card-title">{{$page_title}}</h3>

                            <?php

                            $permission = helperPermission();

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];

                            ?>
                            <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip" title="Add New">
                                <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                            <a href="{{url($page_url)}}" class="pull-right" data-toggle="tooltip" title="View List">
                                <i class="fa fa-list fa-2x"></i></a>
                            @if($allowAdd)
                            <a href="" class="pull-right" data-toggle="modal" data-target="#addModal" title="Add New">
                                <i class="fa fa-plus-circle fa-2x"></i></a>
                            @include('backend.HeaderMenu.add')
                            @endif

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($allowEdit)
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModal" data-placement="top" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            @include('backend.HeaderMenu.edit')
                            @endif
                            <table id="example2" class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name : </th>
                                        <td>{{$value->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Menu Type</th>
                                        <td>{{$value->menu_type}}</td>
                                    </tr>

                                    <tr>
                                        <th>Parent Menu : </th>
                                        <td>
                                        @foreach($parentMenus as $parentMenu)
                                            @if($parentMenu->id==$value->parent_menu_id)
                                            {{$parentMenu->name}}
                                            @endif
                                            @endforeach

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Page Url :</th>
                                        <td>
                                            {{$value->page_url}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Module Url :</th>
                                        <td>
                                            {{$value->module_url}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>External Url :</th>
                                        <td>
                                            {{$value->external_url}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Display Order :</th>
                                        <td>
                                            {{$value->display_order}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 110px;">Status : </th>
                                        <td>
                                            @if($value->status=='active')
                                            <span class="text-success">{{$value->status}}</span>
                                            @else
                                            <span class="text-danger">{{$value->status}}</span>
                                            @endif

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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