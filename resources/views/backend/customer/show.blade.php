@extends('backend.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1><span class="text text-info">{{$details->customer_name}}</span> {{trans('Details')}}
                            <a href="{{route('customer'.'.'.'edit',[$details->id])}}"
                               class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </h1>

                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url($page_url)}}">{{trans('Customer')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('app.details')}}</li>
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
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle img-responsive"
                                         src="{{asset('/images/dummyUser.gif')}}" alt="Profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{$details->customer_name}}</h3>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-location-arrow mr-1"></i> Address</strong>

                                <p class="text-muted">
                                    {{$details->address}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-phone mr-1"></i> Contact Number</strong>

                                <p class="text-muted">{{$details->contact}}</p>

                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email Address</strong>

                                <p class="text-muted">
                                    @if($details->email !=null)
                                        {{$details->email}}
                                    @else
                                        Not Available
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-cube mr-1"></i> Status</strong>

                                <!-- Trigger the modal with a button -->
                                <?php
                                $key = $details->id;
                                ?>
                                @if($details->status == '1')
                                    <button class="btn btn-danger btn-xs" data-toggle="modal"
                                            data-target="#updateStatusModal"
                                            data-placement="top" title="Update Status"
                                    >{{customerStatus($details->status)}}</button>
                                @elseif($details->status == '2')
                                    <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                            data-target="#updateStatusModal"
                                            data-placement="top"
                                            title="Update Status">{{customerStatus($details->status)}}</button>

                                @elseif($details->status == '3')
                                    <button class="btn btn-success btn-xs" data-toggle="modal"
                                            data-target="#updateStatusModal"
                                            data-placement="top"
                                            title="Update Status">{{customerStatus($details->status)}}</button>
                                @elseif($details->status == '4')
                                    <button class="btn btn-warning btn-xs" data-toggle="modal"
                                            data-target="#updateStatusModal"
                                            data-placement="top"
                                            title="Update Status">{{customerStatus($details->status)}}</button>
                                @elseif($details->status == '5')
                                    <button class="btn btn-primary btn-xs">{{customerStatus($details->status)}}</button>
                                @else
                                    <button class="btn btn-secondary btn-xs" data-toggle="modal"
                                            data-target="#updateStatusModal"
                                            data-placement="top"
                                            title="Update Status">{{'Initial'}}</button>
                                @endif

                                {{-- status modal--}}
                                <div class="modal fade" id="updateStatusModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header btn-info">
                                                <h4 class="modal-title">{{trans('Are you sure you want to update status?')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true" data-toggle="tooltip"
                                                          title="Close">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        $updateStatusList = '';
                                                        $updateStatusList = \Illuminate\Support\Facades\DB::table('customer_status')
                                                            ->where('id', '<>', $details->status)
                                                            ->get();
                                                        ?>

                                                        {!! Form::open(['method'=>'post','url'=>'customerUpdateStatus']) !!}
                                                        <input type="hidden" name="customer_id"
                                                               value="{{$details->id}}">
                                                        <div class="form-group">
                                                            <label for="inputName">{{trans('Status Name')}}</label>
                                                            <label class="text-danger">*</label>
                                                            {!! Form::select('status_id',$updateStatusList->pluck('name','id'),null,['style' => 'width:100%','class'=>'form-control select2 status_id','id'=>'status_id','placeholder'=>'Please Select Status','required']) !!}

                                                            {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                                        </div>

                                                            <div class="form-group followup-date {{ ($errors->has('details'))?'has-error':'' }}">
                                                                <label for="inputDescription">{{trans('Follow Up Date')}}</label>
                                                                {{ Form::text('followup_date',null,['placeholder'=>' Followup Date','autocomplete'=>'off','class' => 'form-control followDate','readonly']) }}
                                                                {!! $errors->first('followup_date', '<span class="text-danger">:message</span>') !!}
                                                            </div>
                                                        <div class="form-group {{ ($errors->has('remarks'))?'has-error':'' }}">
                                                            <label for="inputDescription">{{trans('app.details')}}</label>
                                                            {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Enter  Remarks','rows'=>'4','autocomplete'=>'off']) !!}
                                                            {!! $errors->first('remarks', '<span class="label label-danger">:message</span>') !!}
                                                        </div>


                                                        <div class="modal-footer justify-content-center">

                                                            <button type="submit"
                                                                    class="btn btn-success">{{trans('app.update')}}</button>
                                                            &nbsp; &nbsp;
                                                            <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">
                                                                {{trans('app.cancel')}}
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>


                                <hr>

                                <strong><i class="fas fa-calendar mr-1"></i> Created Date</strong>

                                <p class="text-muted">
                                    {{$details->created_date}}
                                    &nbsp;
                                    <small class="badge badge-secondary"> <i class="far fa-clock"></i>
                                        {{ Carbon\Carbon::parse($details->created_at)->diffForHumans()}}
                                    </small>

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

                                $permission = helperPermissionLink(url('/customer/create'), url('/customer'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>

                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#status" data-toggle="tab">Status
                                            History</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#product" data-toggle="tab">Purchase
                                            Product</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#payment"
                                                            data-toggle="tab">Payments</a></li>
                                </ul>


                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="status">
                                        <!-- Post -->
                                        <div class="post">
                                            <table id="example2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>S.N.</th>
                                                    <th> Status</th>
                                                    <th> Follow Up Date</th>
                                                    <th> Note</th>
                                                    <th> Called By</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($status_history as $key =>$status)
                                                    <tr>
                                                        <th scope=row>{{ ($status_history->currentpage()-1) * $status_history->perpage() + $key+1 }}</th>
                                                        <td>
                                                            @if($status->status_id == '1')
                                                                <button class="btn btn-danger btn-xs">{{customerStatus($status->status_id)}}</button>
                                                            @elseif($status->status_id == '2')
                                                                <button class="btn btn-secondary btn-xs">{{customerStatus($status->status_id)}}</button>

                                                            @elseif($status->status_id == '3')
                                                                <button class="btn btn-success btn-xs">{{customerStatus($status->status_id)}}</button>
                                                            @elseif($status->status_id == '4')
                                                                <button class="btn btn-warning btn-xs">{{customerStatus($status->status_id)}}</button>
                                                            @elseif($status->status_id == '5')
                                                                <button class="btn btn-primary btn-xs">{{customerStatus($status->status_id)}}</button>
                                                            @else
                                                                <button class="btn btn-secondary btn-xs">{{'initial'}}</button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $followUpDate = \Carbon\Carbon::parse($status->followup_date, 'UTC');
                                                            ?>
                                                            <span>{{$followUpDate->isoFormat('MMM Do YYYY')}}</span>

                                                        </td>
                                                        <td>
                                                            @if($status->remarks !=null)
                                                                {{$status->remarks}}
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($status->statusBy->full_name)
                                                                @if($status->created_by == \Illuminate\Support\Facades\Auth::user()->id)
                                                                    <button class="btn btn-secondary btn-xs">You
                                                                    </button>
                                                                @else
                                                                    {{$status->statusBy->full_name}}
                                                                @endif
                                                                    &nbsp;  {{$status->status_date}}
                                                                    <small class="badge badge-secondary"> <i class="far fa-clock"></i>
                                                                        {{ Carbon\Carbon::parse($status->created_at)->diffForHumans()}}
                                                                    </small>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                            <span class="float-right">{{ $status_history->appends(request()->except('page'))->links() }}
                                            </span>

                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="product">

                                        <!-- Post -->
                                        <div class="post">

                                            <table id="example4" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                    <th> Product</th>
                                                    <th> Purchase Office</th>
                                                    <th> Purchase Date</th>
                                                    <th> Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($purchased_products as $key=>$data)
                                                    <tr>
                                                        <th scope=row>{{ ($purchased_products->currentpage()-1) * $purchased_products->perpage() + $key+1 }}</th>
                                                        <td>
                                                            @if(isset($data->product->product_name))
                                                                {{$data->product->product_name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(isset($data->office->office_name))
                                                                {{$data->office->office_name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{$data->purchase_date}}
                                                            &nbsp;
                                                            <small class="badge badge-secondary"> <i class="far fa-clock"></i>
                                                                {{ Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            @if($status->remarks !=null)
                                                                {{$status->remarks}}
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            <span class="float-right">{{ $purchased_products->appends(request()->except('page'))->links() }}
                                            </span>
                                        </div>
                                        <!-- /.post -->

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="payment">
                                        <!-- Post -->
                                        <div class="post">
                                            <table id="example5" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">S.N.</th>
                                                    <th>Product</th>
                                                    <th>Payment Method</th>
                                                    <th>Payment Details</th>
                                                    <th>Remarks</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($payments as $key=>$payment)
                                                    <tr>
                                                        <th scope=row>{{ ($payments->currentpage()-1) * $payments->perpage() + $key+1 }}</th>
                                                        <td>
                                                            {{$payment->product->product_name}}
                                                        </td>
                                                        <td>
                                                            {{$payment->PaymentMethod->method_name}}
                                                        </td>
                                                        <td>
                                                            Paid Date: {{$payment->paid_date}}<br/>
                                                            Paid Amount: {{$payment->paid_amount}}<br/>
                                                        </td>
                                                        <td>
                                                            {{$payment->remarks}}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            <span class="float-right">{{ $payments->appends(request()->except('page'))->links() }}
                                            </span>
                                        </div>
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