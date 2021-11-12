@extends('backend.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1>{{ trans('Client Detail') }}
                        </h1>

                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url($page_url) }}">{{ trans('Client') }}</a></li>
                            <li class="breadcrumb-item active">{{ trans('app.details') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="profile-username text-center">{{'Visited By' }}</h4>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle img-responsive"
                                        src="{{ asset('/images/dummyUser.gif') }}" alt="Profile picture">
                                </div>

                                <p class="profile-username text-center">{{ $appUserDetail->full_name }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><strong> About</strong></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-location-arrow mr-1"></i> Address</strong>

                                <p class="text-muted">
                                    {{ $appUserDetail->address }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-phone mr-1"></i> Office</strong>

                                <p class="text-muted">{{ $appUserDetail->office->office_name }}</p>

                                <hr>

                                <strong><i class="fas fa-phone mr-1"></i> Designation</strong>
                                <p class="text-muted">{{ $appUserDetail->office->designation_name }}</p>
                                <hr />
                                <strong><i class="fas fa-phone mr-1"></i> Contact Number</strong>
                                <p class="text-muted">{{ $appUserDetail->mobile }}</p>
                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email Address</strong>

                                <p class="text-muted">
                                    @if ($details->email != null)
                                        {{ $appUserDetail->email }}
                                    @else
                                        Not Available
                                    @endif
                                </p>

                                <hr>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <?php
                                
                                $permission = helperPermissionLink(url('/dsr'), url('/dsr'));
                                
                                $allowEdit = $permission['isEdit'];
                                
                                $allowDelete = $permission['isDelete'];
                                
                                $allowAdd = $permission['isAdd'];
                                ?>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="status">
                                        <!-- Post -->
                                        <div class="post">
                                            <table id="example2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">
                                                            Client Detail
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <i class="fa fa-calendar"> </i> <label>Visited Date
                                                                : </label> {{ $details->date_of_visit }}

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 150px;">Name : </td>
                                                        <td>
                                                            {{ $details->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address : </td>
                                                        <td>
                                                            {{ $details->address }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Contact No. : </td>
                                                        <td>
                                                            {{ $details->contact_no }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Next Date Of Visit : </td>
                                                        <td>
                                                            {{ $details->next_date_of_visit }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status : </td>
                                                        <td>
                                                            @if ($details->status_id == '1')
                                                            <button class="btn btn-danger btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{ $details->id}}"
                                                                data-placement="top"
                                                                title="Update Status">{{ customerStatus($details->status_id) }}</button>
                                                        @elseif($details->status_id == '2')
                                                            <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{ $details->id}}"
                                                                data-placement="top"
                                                                title="Update Status">{{ customerStatus($details->status_id) }}</button>

                                                        @elseif($details->status_id == '3')
                                                            <button class="btn btn-success btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{ $details->id}}"
                                                                data-placement="top"
                                                                title="Update Status">{{ customerStatus($details->status_id) }}</button>
                                                        @elseif($details->status_id == '4')
                                                            <button class="btn btn-warning btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{ $details->id}}"
                                                                data-placement="top"
                                                                title="Update Status">{{ customerStatus($details->status_id) }}</button>
                                                        @elseif($details->status_id == '5')
                                                            <button
                                                                class="btn btn-primary btn-xs">{{ customerStatus($details->status_id) }}</button>
                                                        @else
                                                            <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                                                data-target="#updateStatusModal{{ $details->id}}"
                                                                data-placement="top"
                                                                title="Update Status">{{ 'Initial' }}</button>
                                                        @endif
                                                        <?php $count=$details->id;$client=$details?>
                                                        @include('backend.modal.client_update_status_modal')
                                                           
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No . :</td>
                                                        <td>{{ $details->no }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>TDS :</td>
                                                        <td>{{ $details->tds }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Remarks :</td>
                                                        <td>{{ $details->remarks }}</td>
                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>
                                        <!-- /.post -->
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection
