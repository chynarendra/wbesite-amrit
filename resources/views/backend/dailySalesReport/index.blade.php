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
                        <h1 class="m-0">{{ $page_title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">
                                    {{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item">{{ trans('app.list') }}</li>
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
                                <h3 class="card-title">{{ 'Client List' }}</h3>

                                <?php
                                $permission = helperPermissionLink(url($page_url), url($page_url));
                                
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
                                        <div id="search" class="panel-collapse collapse @if ($request->office_id != null || $request->from_date != null || $request->to_date != null || $request->mobile != null)show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form action="{{ url($page_url) }}" autocomplete="off">
                                                    <tr>
                                                        <td>
                                                            {{ Form::select('office_id', $officeList->pluck('office_name', 'id'), Request::get('office_id'), ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => 'Select Office']) }}

                                                        </td>

                                                        <td>
                                                            {!! Form::number('mobile', Request::get('mobile'), ['class' => 'form-control', 'autocomplete' => 'off', 'width' => '100%', 'placeholder' => trans('Mobile Number')]) !!}
                                                        </td>
                                                        <td>
                                                            {!! Form::text('from_date', Request::get('from_date'), ['class' => 'form-control', 'id' => 'from_date', 'autocomplete' => 'off', 'width' => '100%', 'placeholder' => trans('From Date'), 'readonly']) !!}
                                                        </td>

                                                        <td>
                                                            {!! Form::text('to_date', Request::get('to_date'), ['class' => 'form-control', 'id' => 'to_date', 'autocomplete' => 'off', 'width' => '100%', 'placeholder' => trans('To Date'), 'readonly']) !!}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-search"></i> {{ trans('app.filter') }}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{ url($page_url) }}" class="btn btn-default"> <i
                                                                    class="fas  fa-sync-alt"></i>
                                                                {{ trans('app.refresh') }}
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

                                @if (sizeof($results) > 0)
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">{{ trans('app.sn') }}</th>
                                            <th style="width: 200px">{{ 'Field Visit Detail' }}</th>
                                            <th style="width: 200px">{{ 'Name' }}</th>
                                            <th>{{ 'Address' }}</th>
                                            <th style="width: 200px">{{ 'Contact No.' }}</th>
                                            <th style="width: 200px">{{ 'Next Date of Visit' }}</th>
                                            <th>{{ trans('app.status') }}</th>
                                            <th style="width: 30px">{{ trans('app.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0;
                                        $key = 0;?>

                                            @foreach ($results as $clients)
                                                <?php $count++; ?>
                                                @foreach ($clients as $client)
                                                    <?php $count++; ?>
                                                    <tr>
                                                        <th scope=row>

                                                            {{ ($clients->currentpage() - 1) * $clients->perpage() + $key + 1 }}

                                                        </th>
                                                        <td>
                                                            <i class="fa fa-user"> </i> <label> Visited By
                                                                : </label> {{ $client->visited_by }}
                                                            <br>
                                                            <i class="fa fa-globe"> </i> <label>Visit Area
                                                                : </label> {{ $client->visited_area }}

                                                        </td>

                                                        <td>
                                                            {{ $client->name }}
                                                        </td>
                                                        <td>
                                                            {{ $client->address }}
                                                        </td>

                                                        <td>
                                                            {{ $client->contact_no }}
                                                        </td>

                                                        <td>
                                                            {{ $client->next_date_of_visit }}
                                                        </td>

                                                        <td>
                                                            @if ($client->status_id == '1')
                                                                <button class="btn btn-danger btn-xs" data-toggle="modal"
                                                                    data-target="#updateStatusModal{{ $count }}"
                                                                    data-placement="top"
                                                                    title="Update Status">{{ customerStatus($client->status_id) }}</button>
                                                            @elseif($client->status_id == '2')
                                                                <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                                                    data-target="#updateStatusModal{{ $count }}"
                                                                    data-placement="top"
                                                                    title="Update Status">{{ customerStatus($client->status_id) }}</button>

                                                            @elseif($client->status_id == '3')
                                                                <button class="btn btn-success btn-xs" data-toggle="modal"
                                                                    data-target="#updateStatusModal{{ $count }}"
                                                                    data-placement="top"
                                                                    title="Update Status">{{ customerStatus($client->status_id) }}</button>
                                                            @elseif($client->status_id == '4')
                                                                <button class="btn btn-warning btn-xs" data-toggle="modal"
                                                                    data-target="#updateStatusModal{{ $count }}"
                                                                    data-placement="top"
                                                                    title="Update Status">{{ customerStatus($client->status_id) }}</button>
                                                            @elseif($client->status_id == '5')
                                                                <button
                                                                    class="btn btn-primary btn-xs">{{ customerStatus($client->status_id) }}</button>
                                                            @else
                                                                <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                                                    data-target="#updateStatusModal{{ $count }}"
                                                                    data-placement="top"
                                                                    title="Update Status">{{ 'Initial' }}</button>
                                                            @endif
                                                        </td>

                                                        <td>

                                                            @if ($allowShow)
                                                                <a href="{{ route($page_route . '.' . 'show', [$client->id]) }}"
                                                                    class="btn btn-secondary btn-xs" data-toggle="tooltip"
                                                                    data-placement="top" title="Details">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    <?php $key++; ?>
                                                    @include('backend.modal.client_update_status_modal')
                                                @endforeach
                                            @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right">{{ $clients->appends(request()->except('page'))->links() }}
                                </span>
                                @else
                                <p class="text-danger text-center">Data are not available !</p>
                                @endif

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
@section('js')
    <script>
        $('#example2').DataTable({
                    scrollY: 300,
                    responsive: true
                    paging: false,
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [0]
                        },
                    });
    </script>
@endsection
