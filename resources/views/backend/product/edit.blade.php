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
                        <h1>{{trans('Product')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{url($page_url)}}">{{trans('Product')}}</a></li>
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

                            $permission = helperPermissionLink(url($page_url . '/' . 'create'), url($page_url));

                            $allowEdit = $permission['isEdit'];

                            $allowDelete = $permission['isDelete'];

                            $allowAdd = $permission['isAdd'];
                            ?>

                        </div>
                        <div class="card-body">
                            {!! Form::model($edits, ['method'=>'put','route'=>[$page_route.'.'.'update',$edits->id],'enctype'=>'multipart/form-data','file'=>true]) !!}
                            <div class="row">

                                <div class="form-group col-md-6 {{ ($errors->has('product_category_id'))?'has-error':'' }}">
                                    <label>Category</label><label class="text-danger">*</label>
                                    {!! Form::select('product_category_id',$productCategoryList->pluck('name','id'),null,['id' => 'categoryId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Product Category
                                    ']) !!}
                                    {!! $errors->first('product_category_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 {{ ($errors->has('product_name'))?'has-error':'' }}">
                                    <label for="feature">Name</label><label class="text-danger">*</label>
                                    {{ Form::text('product_name',null,['placeholder'=>'Product Name','class' => 'form-control']) }}
                                    {!! $errors->first('product_name', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 {{ ($errors->has('warrenty_in_years'))?'has-error':'' }}">
                                    <label for="feature"> Warranty In Years</label><label class="text-danger">*</label>
                                    {{ Form::number('warrenty_in_years',null,['placeholder'=>'Example: 2 years','class' => 'form-control']) }}
                                    {!! $errors->first('warrenty_in_years', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ ($errors->has('about_product'))?'has-error':'' }}">
                                    <label for="feature">Product Details</label>
                                    {{ Form::textarea('about_product',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 300;']) }}
                                </div>

                                <div class="form-group col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">
                                        {{trans('app.update')}}
                                    </button>
                                    &nbsp;
                                    <a  class="btn btn-danger" href="{{url($page_url)}}">{{trans('app.cancel')}}</a>
                                </div>

                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

