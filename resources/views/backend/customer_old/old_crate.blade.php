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
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
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

                            $permission = helperPermissionLink(url($page_url . '/' . 'create'), url($page_url));

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];
                            ?>

                        </div>
                        <div class="card-body">
                            {!! Form::open(['method'=>'post','url'=>$page_url,'enctype'=>'multipart/form-data','file'=>true]) !!}

                            <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('source_id'))?'has-error':'' }}">
                                    <label>Source</label> <label class="text text-danger">*</label>
                                    {!! Form::select('customer_source_id',$sourceList->pluck('name','id'),null,['id' => 'source_id','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Source
                                    ']) !!}
                                    {!! $errors->first('customer_source_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ ($errors->has('campaign_id'))?'has-error':'' }}"
                                     id="campaignId" style="display: none">
                                    <label>Campaign</label><label class="text-danger">*</label>
                                    {!! Form::select('campaign_id',$campaignList->pluck('campaign_name','id'),null,['style' =>'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Campaign
                                    ']) !!}
                                    {!! $errors->first('campaign_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('customer_name'))?'has-error':'' }}">
                                    <label for="feature">Name</label><label class="text-danger">*</label>
                                    {{ Form::text('customer_name',null,['placeholder'=>'Customer Name','class' => 'form-control']) }}
                                    {!! $errors->first('customer_name', '<span class="text-danger">:message</span>') !!}
                                </div>


                                <div class="form-group col-md-4 {{ ($errors->has('address'))?'has-error':'' }}">
                                    <label for="feature"> Address</label><label class="text-danger">*</label>
                                    {{ Form::text('address',null,['placeholder'=>'Customer  Address','class' => 'form-control']) }}
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('contact'))?'has-error':'' }}">
                                    <label for="feature"> Contact</label><label class="text-danger">*</label>
                                    {{ Form::number('contact',null,['placeholder'=>'Customer  Contact Number','class' => 'form-control']) }}
                                    {!! $errors->first('contact', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('email'))?'has-error':'' }}">
                                    <label for="feature"> Email</label>
                                    {{ Form::text('email',null,['placeholder'=>'Customer  Email Address','class' => 'form-control']) }}
                                    {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('followup_date'))?'has-error':'' }}">
                                    <label for="feature"> Status</label><label class="text-danger">*</label>
                                    {{Form::select('status',customerStatus(),Request::get('status'),['class'=>'form-control select2','id'=>'status_id','placeholder'=>
                                                            'Select Customer Status'])}}
                                    {!! $errors->first('status', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>

                            <div id="product_form" style="display: none">

                                <div class="row" id="panel-design">
                                    <div class="form-group col-md-12">
                                        <h4> {{trans('Product Purchase  Area')}}</h4>
                                    </div>
                                    <div id="form_repeater">
                                        <div data-repeater-list="" class="col-md-12">
                                            <div data-repeater-item class="form-group m-form__group row align-items-center">
                                                <div class="form-group col-md-4">
                                                    <label>Product</label> <label class="text-danger">*</label>
                                                    <div class="select2-blue">
                                                        <select class="form-control select2" multiple="multiple" data-placeholder="Select Products"  name="product_id[]"  style="width: 100%" autocomplete="off">
                                                            @foreach($productList as $data)
                                                                <option class='form control' value='{{ $data->id }}'  {{ old('product_id') == $data->id ? "selected" :""}} >
                                                                    {{ $data->product_name  }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Office</label> <label class="text-danger">*</label>
                                                    <div class="select2-blue">
                                                        <select class="form-control select2" multiple="multiple" data-placeholder="Select Office"  name="office_id[]"  style="width: 100%" autocomplete="off">
                                                            @foreach($officeList as $data)
                                                                <option class='form control' value='{{ $data->id }}'  {{ old('office_id') == $data->id ? "selected" :""}} >
                                                                    {{ $data->office_name  }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="feature">Purchase Date</label><label
                                                            class="text-danger">*</label>
                                                    {{ Form::text('purchase_date[]',null,['multiple' => true,'placeholder'=>'YYYY-MM-DD','class' => 'form-control purchaseDate','autocomplete'=>'off']) }}

                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="feature">Remarks</label>
                                                    {{ Form::textarea('remarks',null,['placeholder'=>'Remarks','class' => 'form-control','rows'=>'4']) }}
                                                </div>
                                                <div class="col-md-12">
                                                    <div data-repeater-delete=""
                                                         class="btn-sm btn btn-danger float-right">
                                                    <span>
                                                        <i class="fa fa-trash"></i>

                                                        <span>Delete</span>

                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div data-repeater-create="" class="btn-success btn btn-sm float-left">
                                                    <span><i class="fa fa-plus"></i>
                                                        <span>Add More</span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group col-md-4 {{ ($errors->has('followup_date'))?'has-error':'' }}"
                                     id="follow_up_date" style="display:block;">
                                    <label for="feature"> Followup Date</label>
                                    {{ Form::text('followup_date',null,['placeholder'=>' Followup Date','id'=>'follow_date','autocomplete'=>'off','class' => 'form-control','readonly']) }}
                                    {!! $errors->first('followup_date', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ ($errors->has('about_product'))?'has-error':'' }}"  style="margin-top: 20px;">
                                    <label for="feature">Customer View</label>
                                    {{ Form::textarea('note',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 200;']) }}
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
                                <a class="btn btn-danger" href="{{url($page_url)}}">{{trans('app.cancel')}}</a>
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
