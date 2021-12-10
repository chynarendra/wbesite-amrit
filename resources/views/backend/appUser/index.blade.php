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
                                $permission = helperPermissionLink(url($data['page_url']), url($data['page_url']));
                                $allowEdit = $permission['isEdit'];
                                $allowDelete = $permission['isDelete'];
                                $allowAdd = $permission['isAdd'];
                                $allowShow = $permission['isShow'];
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
                                             class="panel-collapse collapse @if($data['request']->office_id != null ||  $data['request']->designation_id != null ||  $data['request']->mobile != null ||  $data['request']->name != null)show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form
                                                        action="{{url($data['page_url'])}}" autocomplete="off">
                                                    <tr>
                                                        <td>
                                                            {{Form::select('office_id',$data['officeList']->pluck('office_name','id'),Request::get('office_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                            'Select Office'])}}

                                                        </td>
                                                        <td>
                                                            {{Form::select('designation_id',$data['designationList']->pluck('name','id'),Request::get('designation_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                            'Select Designation'])}}
                                                        </td>

                                                        <td>
                                                            {!!Form::text('name',Request::get('name'),['class'=>'form-control','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('Name')]) !!}
                                                        </td>

                                                        <td>
                                                            {!!Form::number('mobile',Request::get('mobile'),['class'=>'form-control','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('Mobile Number')]) !!}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"
                                                            class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                        class="fa fa-search"></i> {{trans('app.filter')}}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{url($data['page_url'])}}"
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
                                        <th>{{trans('Name')}}</th>
                                        <th>{{trans('Email')}}</th>
                                        <th>{{trans('Mobile')}}</th>
                                        <th>{{trans('Office')}}</th>
                                        <th>{{trans('Designation')}}</th>
                                        <th>{{trans('Register Date')}}</th>
                                        <th>{{trans('app.status')}}</th>
                                        <th style="width: 160px">{{trans('app.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['results'] as $key=>$appUser)
                                        <tr>
                                            <th scope=row>{{ ($data['results']->currentpage()-1) * $data['results']->perpage() + $key+1 }}</th>
                                            <td>{{$appUser->full_name}}</td>
                                            <td>{{$appUser->email}}</td>
                                            <td>{{$appUser->mobile}}</td>
                                            <td>
                                                @if($appUser->office_id !=null)
                                                {{$appUser->office->office_name}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($appUser->designation_id !=null)
                                                    <?php
                                                    ?>
                                                    {{$appUser->designation->designation_name}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$appUser->register_date}}
                                            </td>
                                            <td>
                                                @if($appUser->status == '1')
                                                    <a href="{{url('/appUser/approve/'.$appUser->id)}}" class="btn btn-success btn-xs">{{'Approved'}}</a>
                                                @else
                                                    <a href="{{url('/appUser/approve/'.$appUser->id)}}" class="btn btn-danger btn-xs">{{'Disable'}}</a>
                                                @endif

                                            </td>

                                            <td>
                                                @if($allowShow)
                                                    <a href="{{route('appUser.show',[$appUser->id])}}"
                                                       class="btn btn-secondary btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="Details">
                                                        <i class="fas fa-eye"></i>
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
                                        <?php $page_route=$data['page_route']?>
                                        @include('backend.appUser.delete_modal')
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
