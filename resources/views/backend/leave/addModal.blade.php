<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #6c757d">
                <h4 class="modal-title">{{trans('app.add')}}</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    {!! Form::open(['method'=>'post','url'=>$page_url]) !!}

                    <div class="col-md-12" style="text-align: left;">

                        <div class="form-group">
                            <label for="inputName">{{trans('app.SalesStaff')}}</label> <label class="text text-danger">*</label>
                            {!! Form::select('app_user_id',$appUsers->pluck('full_name','id'),null,['style' =>'width:100%','class'=>'form-control select2','required'=>'required','placeholder'=>trans('app.SalesStaff'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('app_user_id', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="inputName">{{trans('app.leave')}} {{trans('app.start_date')}}</label> <label class="text text-danger">*</label>
                            {!! Form::text('leave_start_date',null,['class'=>'form-control','id'=>'leave_from_date','required'=>'required','placeholder'=>trans('app.leave').' '.trans('app.start_date'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('leave_start_date', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="inputName">{{trans('app.leave')}} {{trans('app.end_date')}}</label> <label class="text text-danger">*</label>
                            {!! Form::text('leave_end_date',null,['class'=>'form-control','id'=>'leave_to_date','required'=>'required','placeholder'=>trans('app.leave').' '.trans('app.end_date'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('leave_end_date', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="inputName">{{trans('app.status')}}</label> <label class="text text-danger">*</label>
                            {!! Form::select('status',$statuses,null,['style' =>'width:100%','class'=>'form-control select2','required'=>'required','placeholder'=>trans('app.status'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('status', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group {{ ($errors->has('reason'))?'has-error':'' }}"  style="margin-top: 20px;">
                            <label for="reason">Reason</label>
                            {{ Form::textarea('reason',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 200;']) }}
                        </div>

                        <div class="modal-footer justify-content-center">

                            <button type="submit"
                                    class="btn btn-primary">{{trans('app.save')}}</button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">
                                {{trans('app.cancel')}}
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>