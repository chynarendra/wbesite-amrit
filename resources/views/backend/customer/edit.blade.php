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
                            <li class="breadcrumb-item active">{{trans('app.edit')}}</li>
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
                            <h3 class="card-title"> {{trans('app.edit')}}</h3>
                            <?php

                            $permission = helperPermissionLink(url($page_url.'/'.'create'), url($page_url));

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];
                            ?>

                        </div>
                        <div class="card-body">
                            {!! Form::model($edits, ['method'=>'put','route'=>[$page_route.'.'.'update',$edits->id],'enctype'=>'multipart/form-data','file'=>true]) !!}

                            <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('source_id'))?'has-error':'' }}">
                                    <label>Source</label> <label class="text text-danger">*</label>
                                    {!! Form::select('customer_source_id',$sourceList->pluck('name','id'),null,['id' => 'source_id','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Source
                                    ']) !!}
                                    {!! $errors->first('customer_source_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('campaign_id'))?'has-error':'' }}"
                                     id="champaign_list" <?php echo ($edits->campaign_id !=null)?'style="display: block;"':'style="display: none;"' ?>>
                                    <label>Campaign</label><label class="text-danger">*</label>
                                    {!! Form::select('campaign_id',$campaignList->pluck('campaign_name','id'),null,['style' =>'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Campaign
                                    ']) !!}
                                    {!! $errors->first('campaign_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('reference_source'))?'has-error':'' }}" id="reference-source"
                                     <?php echo ($edits->reference_source !=null)?'style="display: block;"':'style="display: none;"' ?>>
                                    <label for="reference_source">Reference Source</label>
                                    {{ Form::text('reference_source',null,['placeholder'=>'Reference Source','class' => 'form-control']) }}
                                    {!! $errors->first('reference_source', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('reference_phone_no'))?'has-error':'' }}" id="reference-phone"
                                <?php echo ($edits->reference_phone_no !=null)?'style="display: block;"':'style="display: none;"' ?>>
                                    <label for="reference_phone_no">Reference Phone No</label>
                                    {{ Form::text('reference_phone_no',null,['placeholder'=>'Reference Phone No','class' => 'form-control']) }}
                                    {!! $errors->first('reference_phone_no', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('customer_name'))?'has-error':'' }}">
                                    <label for="feature">Name</label><label class="text-danger">*</label>
                                    {{ Form::text('customer_name',null,['placeholder'=>'Customer Name','class' => 'form-control']) }}
                                    {!! $errors->first('customer_name', '<span class="text-danger">:message</span>') !!}
                                </div>


                                <div class="form-group col-md-4 {{ ($errors->has('address'))?'has-error':'' }}">
                                    <label for="feature"> Address</label>
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
                                    <label for="feature"> Status</label>
                                    {{Form::select('status',customerStatus(),Request::get('status'),['class'=>'form-control select2','placeholder'=>
                                                            'Select Customer Status'])}}
                                    {!! $errors->first('status', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>
                            <hr/>

                            <div class="row">

                                <div class="form-group col-md-4 {{ ($errors->has('followup_date'))?'has-error':'' }}">
                                    <label for="feature"> Followup Date</label>
                                    {{ Form::text('followup_date',null,['placeholder'=>' Followup Date','id'=>'follow_date','autocomplete'=>'off','class' => 'form-control','readonly']) }}
                                    {!! $errors->first('followup_date', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ ($errors->has('about_product'))?'has-error':'' }}">
                                    <label for="feature">Customer View</label>
                                    {{ Form::textarea('note',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 200;']) }}
                                </div>

                            </div>

                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    {{trans('app.update')}}
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


