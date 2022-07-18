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
                            <table id="example2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10px">{{trans('app.sn')}}</th>
                                        <th>Name</th>
                                        <th>Parent Menu</th>
                                        <th>Menu Type</th>
                                        <th>Page</th>
                                        <th>Module</th>
                                        <th>External Url</th>
                                        <th>Display Order</th>
                                        <th>{{trans('app.status')}}</th>
                                        <th>{{trans('app.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $key=>$data)
                                    <tr>
                                        <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                        <td>
                                            {{$data->name}}
                                        </td>

                                        <td>
                                            @foreach($parentMenus as $parentMenu)
                                            @if($parentMenu->id==$data->parent_menu_id)
                                            {{$parentMenu->name}}
                                            @endif
                                            @endforeach
                                        </td>

                                        <td>
                                            {{$data->menu_type }}
                                        </td>

                                        <td>
                                            {{$data->page_url }}
                                        </td>

                                        <td>
                                            {{$data->module_url }}
                                        </td>

                                        <td>
                                            {{$data->external_url }}
                                        </td>

                                        <td>
                                            {{$data->display_order }}
                                        </td>

                                        <td>
                                            @if($data->status == 'active')
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#statusModal{{$key}}" title="Click here update  status">
                                                {{trans('app.active')}}
                                            </button>
                                            @elseif($data->status== 'inactive')
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#statusModal{{$key}}" title="Click here update  status">
                                                {{trans('app.inactive')}}
                                            </button>
                                            @endif
                                        </td>
                                        <td>
                                    
                                            <a href="{{url('/admin/menus/'.$data->id)}}" class="btn btn-info btn-xs">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if($allowDelete)
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal{{$key}}" data-placement="top" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif

                                        </td>
                                    </tr>
                                    @include('backend.modal.status_modal')
                                    @include('backend.modal.delete_modal')

                                    @endforeach
                                </tbody>
                            </table>
                            <span class="float-right">{{ $results->appends(request()->except('page'))->links() }}
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