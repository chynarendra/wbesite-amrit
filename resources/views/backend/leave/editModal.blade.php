<div class="modal fade" id="editModal{{$key}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title">{{trans('app.edit')}}</h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    {!! Form::model($leave,['method'=>'PUT','route'=>[$page_route.'.'.'update',$leave->id]]) !!}
                    <div class="col-md-12" style="text-align: left;">

                        <div class="form-group">
                            <label for="inputName">{{trans('app.SalesStaff')}}</label> <label
                                    class="text text-danger">*</label>
                            {!! Form::select('app_user_id',$appUsers->pluck('full_name','id'),null,['style' =>'width:100%','class'=>'form-control select2','required'=>'required','placeholder'=>trans('app.SalesStaff'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('app_user_id', '<small class="text text-danger">:message</small>') !!}
                        </div>


                        <div class="form-group">
                            <label for="inputName">{{trans('app.leave')}} {{trans('app.date')}}</label> <label
                                    class="text text-danger">*</label>
                            {!! Form::text('leave_date',null,['class'=>'form-control','id'=>'leave_date','required'=>'required','placeholder'=>trans('app.leave').' '.trans('app.date'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('leave_date', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group">
                            <label for="inputName">{{trans('app.status')}}</label> <label
                                    class="text text-danger">*</label>
                            {!! Form::select('status',$statuses,null,['style' =>'width:100%','class'=>'form-control select2','required'=>'required','placeholder'=>trans('app.status'),'autocomplete'=>'off']) !!}
                            {!! $errors->first('status', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group {{ ($errors->has('reason'))?'has-error':'' }}" style="margin-top: 20px;">
                            <label for="reason">Reason</label>
                            {{ Form::textarea('reason',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 200;']) }}
                        </div>

                        <div class="modal-footer justify-content-center">

                            <button type="submit"
                                    class="btn btn-success">{{trans('app.update')}}</button>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <button type="button"
                                    class="btn btn-danger"
                                    data-dismiss="modal">
                                {{trans('app.cancel')}}
                            </button>
                        </div>


                    </div>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>