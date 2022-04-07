@extends('backend.layouts.app')
<title>@yield('page_title','General Information Registration')</title>
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{'General Information Registration'}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{url('users')}}">{{'General Information Registration'}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.edit')}}</li>
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
                                <h3 class="card-title">{{trans('app.edit')}}</h3>
                                <?php
                                $permission = helperPermission();
                                $allowEdit = $permission['isEdit'];
                                $allowDelete = $permission['isDelete'];
                                $allowAdd = $permission['isAdd'];
                                ?>
                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Add New">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url('/general/info')}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i></a>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            <div class="card-body">
                                {!! Form::model($data,['method'=>'PUT','url'=>['/general/info/update/'.$data->id]]) !!}
                                <div class="row col-md-12">

                                    <div class="col-md-2">
                                        <div class="form-group {{ ($errors->has('REF_NO'))?'has-error':'' }}">
                                            <label>Ref. No.</label>
                                            <label class="text text-danger">*</label>
                                            {!! Form::text('REF_NO',null,['class'=>'form-control','placeholder'=>'Ref No.']) !!}
                                            {!! $errors->first('REF_NO', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Ref. Date :</label><label class="text text-danger">*</label>
                                        <div class="form-group {{ ($errors->has('REF_DT_NEP'))?'has-error':'' }}">
                                            {!! Form::text('REF_DT_NEP',null,['class'=>'form-control','id'=>'refDateNp','placeholder'=>'B.S.']) !!}
                                            {!! $errors->first('REF_DT_NEP', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2" style="margin-top: 30px;">
                                        <div class="form-group {{ ($errors->has('REF_DT_ENG'))?'has-error':'' }}">
                                            {!! Form::text('REF_DT_ENG',null,['class'=>'form-control','id'=>'refDateEng','placeholder'=>'A.D']) !!}
                                            {!! $errors->first('REF_DT_ENG', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group {{ ($errors->has('REG_NO'))?'has-error':'' }}">
                                            <label>Reg. No.</label>
                                            <label class="text text-danger">*</label>
                                            {!! Form::text('REG_NO',null,['class'=>'form-control','placeholder'=>'Reg No.']) !!}
                                            {!! $errors->first('REG_NO', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group {{ ($errors->has('REG_DT_NEP'))?'has-error':'' }}">
                                            <label>Reg. Date</label>
                                            <label class="text text-danger">*</label> :
                                            {!! Form::text('REG_DT_NEP',null,['class'=>'form-control','id'=>'regDateNp','placeholder'=>'B.S.']) !!}
                                            {!! $errors->first('REG_DT_NEP', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2" style="margin-top: 30px;">
                                        <div class="form-group {{ ($errors->has('REG_DT_ENG'))?'has-error':'' }}">
                                            {!! Form::text('REG_DT_ENG',null,['class'=>'form-control','id'=>'regDateEng','placeholder'=>'A.D.']) !!}
                                            {!! $errors->first('REG_DT_ENG', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group {{ ($errors->has('ISSUED_BY'))?'has-error':'' }}">
                                            <label>Issued By</label><label class="text text-danger">*</label>
                                            {!! Form::text('ISSUED_BY',null,['class'=>'form-control','placeholder'=>'Issued By']) !!}
                                            {!! $errors->first('ISSUED_BY', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ ($errors->has('ADDRESS'))?'has-error':'' }}">
                                            <label>Address</label><label class="text text-danger">*</label>
                                            {!! Form::text('ADDRESS',null,['class'=>'form-control','placeholder'=>'Address']) !!}
                                            {!! $errors->first('ADDRESS', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ ($errors->has('SUBJECT'))?'has-error':'' }}">
                                            <label>Subject</label><label class="text text-danger">*</label>
                                            {!! Form::text('SUBJECT',null,['class'=>'form-control','placeholder'=>'Subject']) !!}
                                            {!! $errors->first('SUBJECT', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ ($errors->has('REMARKS'))?'has-error':'' }}">
                                            <label>Remarks</label>
                                            {!! Form::text('REMARKS',null,['class'=>'form-control','placeholder'=>'Remarks']) !!}
                                            {!! $errors->first('REMARKS', '<span class="text text-danger">:message</span>') !!}
                                        </div>
                                    </div>

                                </div>
                                <hr/>
                                <div class="row col-md-12">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="save">Update</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- Add Modal Start -->
                        <!-- /.row -->
                        <!-- /.container-fluid -->
                        <!-- /.content -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
