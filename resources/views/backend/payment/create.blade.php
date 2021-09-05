@extends('backend.layouts.app')
<title>@yield('page_title',$page_title)</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{trans('Customer')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url($page_url)}}">{{trans('Customer')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('app.add')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="card card-default">
                        <div class="card-header with-border">
                            <h3 class="card-title"> {{trans('app.add')}}</h3>
                            <?php

                            $permission = helperPermissionLink(url($page_url.'/'.'create'), url($page_url));

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];
                            ?>

                        </div>
                        <div class="card-body">
                            {!! Form::open(['method'=>'post','url'=>$page_url]) !!}

                            <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('customer_id'))?'has-error':'' }}">
                                    <label> Customer</label><label class="text-danger">*</label>
                                    {!! Form::select('customer_id',$customerList->pluck('customer_name','id'),null,['id' => 'cityId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Customer
                                    ']) !!}
                                    {!! $errors->first('customer_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('product_id'))?'has-error':'' }}">
                                    <label> Product</label><label class="text-danger">*</label>
                                    {!! Form::select('product_id',$productList->pluck('product_name','id'),null,['id' => 'cityId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Product
                                    ']) !!}
                                    {!! $errors->first('product_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('payment_method_id'))?'has-error':'' }}">
                                    <label> Payment Method</label><label class="text-danger">*</label>
                                    {!! Form::select('payment_method_id',$paymentMethodList->pluck('method_name','id'),null,['id' => 'cityId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Select payment method
                                    ']) !!}
                                    {!! $errors->first('payment_method_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('paid_amount'))?'has-error':'' }}">
                                    <label for="feature">Paid Amount</label><label class="text-danger">*</label>
                                    {{ Form::text('paid_amount',null,['placeholder'=>'Amount ( in Rs.)','class' => 'form-control']) }}
                                    {!! $errors->first('paid_amount', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('paid_date'))?'has-error':'' }}">
                                    <label for="feature">Paid Date</label><label class="text-danger">*</label>
                                    {{ Form::text('paid_date',null,['placeholder'=>'Paid date','class' => 'form-control','id'=>'eng_date','autocomplete'=>'off']) }}
                                    {!! $errors->first('paid_date', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ ($errors->has('remarks'))?'has-error':'' }}">
                                    <label for="feature">Remarks</label>
                                    {{ Form::textarea('remarks',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 300;']) }}

                                    {!! $errors->first('remarks', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>

                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" name="submit" value="1">
                                    {{trans('app.save')}}
                                </button>
                                &nbsp;
                                <button type="submit" class="btn btn-success" name="submit" value="2">
                                    {{trans('Add More')}}
                                </button>
                                &nbsp;
                                <a  class="btn btn-danger" href="{{url($page_url)}}">{{trans('app.cancel')}}</a>
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
