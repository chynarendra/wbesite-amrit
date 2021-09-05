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
                        <h1 class="m-0">{{$page_title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{$page_title}}</a></li>
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
                                @if($request->source_id!= null )
                                    <strong style="margin-right: 350px;"> Total Query Count :
                                        <span style="font-size: 16px; color: #007bff;">{{$totalResult}}</span>
                                    </strong>
                                @endif
                                <?php
                                $permission = helperPermissionLink(url($page_url . '/' . 'create'), url($page_url));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="accordion">
                                        <div class="card-header">
                                            <h4 class="card-title float-right">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#search">
                                                    <i class="fas fa-filter"></i>Filter
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="search"
                                             class="panel-collapse collapse @if($request->source_id )show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form
                                                        action="{{url($page_url)}}" autocomplete="off">
                                                    <tr>
                                                        <td>
                                                            {{Form::select('source_id',$sourceList->pluck('name','id'),Request::get('source_id'),['class'=>'form-control select2','placeholder'=>
                                                            'Select Source'])}}

                                                        </td>

                                                        <td colspan="5"
                                                            class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                        class="fa fa-search"></i> {{trans('app.filter')}}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{url($page_url)}}"
                                                               class="btn btn-default"> <i
                                                                        class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                            </a>
                                                            &nbsp; &nbsp;
                                                            <a class="btn btn-danger" data-toggle="collapse"
                                                               data-parent="#accordion" href="#search">
                                                                <span aria-hidden="true">&times;</span> Close
                                                            </a>
                                                        </td>
                                                    </tr>

                                                </form>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">{{trans('app.sn')}}</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Query Source</th>
                                        <th>Question</th>
                                        <th style="width: 80px">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $key=>$data)
                                        <tr>
                                            <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->address}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->ph_no}}</td>
                                            <td>
                                                @if(isset($data->source->name))
                                                    {{$data->source->name}}
                                                @endif
                                            </td>
                                            <td>{!! $data->question !!}</td>
                                            <td>
                                                @if($allowEdit)
                                                    <a href="{{route($page_route.'.'.'edit',[$data->id])}}"
                                                       class="btn btn-info btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
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
                                                @endif

                                            </td>
                                        </tr>
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
