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
                        <h1>{{trans('Customer Query')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url($page_url)}}">{{trans('Customer Query')}}</a></li>
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
                            {!! Form::open(['method'=>'post','url'=>$page_url,'enctype'=>'multipart/form-data','file'=>true]) !!}

                            <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('source_of_query_id'))?'has-error':'' }}">
                                    <label>Query Source</label><label class="text-danger">*</label>
                                    {!! Form::select('source_of_query_id',$sourceList->pluck('name','id'),null,['style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Source
                                    ']) !!}
                                    {!! $errors->first('source_of_query_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('name'))?'has-error':'' }}">
                                    <label for="feature">Name</label><label class="text-danger">*</label>
                                    {{ Form::text('name',null,['placeholder'=>'Customer Name','class' => 'form-control']) }}
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('address'))?'has-error':'' }}">
                                    <label for="feature">Address</label><label class="text-danger">*</label>
                                    {{ Form::text('address',null,['placeholder'=>'Customer Address','class' => 'form-control']) }}
                                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('email'))?'has-error':'' }}">
                                    <label for="feature">Email</label>
                                    {{ Form::email('email',null,['placeholder'=>'Customer Email Address','class' => 'form-control']) }}
                                    {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('ph_no'))?'has-error':'' }}">
                                    <label for="feature">Phone No.</label><label class="text-danger">*</label>
                                    {{ Form::number('ph_no',null,['placeholder'=>'Customer Contact Number','class' => 'form-control']) }}
                                    {!! $errors->first('ph_no', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ ($errors->has('question'))?'has-error':'' }}">
                                    <label for="feature">Question ?</label>
                                    {{ Form::textarea('question',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 200;']) }}
                                    {!! $errors->first('question', '<span class="text-danger">:message</span>') !!}
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
