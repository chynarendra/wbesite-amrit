@extends('backend.layouts.app')
@section('title')
    Customers
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Purchase Products of   <span class="text-primary">{{$customer->customer_name}}</span></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('/customer')}}"> {{' Customer '}}</a></li>
                            <li class="breadcrumb-item active">Purchase Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('backend.message.flash')

                <div class="row">

                    <div class="col-md-9">
                        <div class="card card-default">
                            <div class="card-header with-border">
                                <h3 class="card-title"><i class="fa fa-list"></i>  {{trans('Product List')}}</h3>
                                <a href="{{url('customer/purchaseproduct/' . $customerId)}}" class="float-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-plus-circle fa-2x"></i>
                                </a>
                                <a href="{{url('/customer/purchaseproduct/' . $customerId)}}" class="float-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i>
                                </a>
                                <a href="{{URL::previous()}}" class="float-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px;">{{trans('app.sn')}}</th>
{{--                                        <th> Customer</th>--}}
                                        <th> Product</th>
                                        <th> Purchase Office</th>
                                        <th> Purchase Date</th>
                                        <th> Remarks</th>
                                        <th style="width: 10px;"
                                            class="text-right">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($purchased_products as $key=>$data)
                                        <tr>
                                            <th scope=row>{{++$key}}</th>
{{--                                            <td>--}}
{{--                                                @if(isset($data->customer->customer_name))--}}
{{--                                                {{$data->customer->customer_name}}--}}
{{--                                                    @endif--}}
{{--                                            </td>--}}
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
                                                <small class="badge badge-secondary"> <i class="far fa-clock"></i>
                                                    {{ Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                                </small>
                                            </td>
                                            <td>
                                                @if($data->remarks !=null)
                                                {{$data->remarks}}
                                                @else
                                                    Not Available
                                                    @endif
                                            </td>

                                            <td class="text-right row" style="margin-right: 0px;">

                                                <a href="{{route('purchaseProduct.edit',[$customerId,$data->id])}}"
                                                   class="btn-info btn-xs"
                                                   data-toggle="tooltip"
                                                   data-placement="top" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                &nbsp;

                                                <button type="button" class="btn btn-danger btn-xs"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal{{$key}}"
                                                        data-placement="top" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="modal fade" id="deleteModal{{$key}}">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-header btn-secondary">
                                                                <h4 class="modal-title"></h4>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['purchaseProduct.delete',
                                                        [$data->id]]]) !!}
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to
                                                                    delete?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button type="submit"
                                                                        class="btn btn-primary">Yes
                                                                </button> &nbsp; &nbsp;
                                                                <button type="button"
                                                                        class="btn btn-default"
                                                                        data-dismiss="modal">No
                                                                </button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>



                    <div class="col-md-3">
                        @if(\Request::segment(3)=='edit')
                            @include('backend.customer.purchaseProduct.edit')
                        @else
                            @include('backend.customer.purchaseProduct.add')
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection