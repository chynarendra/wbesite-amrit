
<div class="modal fade" id="leaveAddModal">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title">{{trans('Add')}}</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'post','url'=>'appUser/'.$id.'/leaves','autocomplete'=>'off']) !!}
                <div class="row">
                    <input type="hidden" name="app_user_id" value="{{$id}}" />

                    <div class="form-group col-md-6 {{ ($errors->has('month_start_date'))?'has-error':'' }}">
                        <label for="feature">Month Start Date</label><label class="text-danger">*</label>
                        {{ Form::text('month_start_date',null,['placeholder'=>'Month start date','id'=>'month_start_date','autocomplete'=>'off','class' => 'form-control','required']) }}
                        {!! $errors->first('month_start_date', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ ($errors->has('month_end_date'))?'has-error':'' }}">
                        <label for="feature">Month End Date</label><label class="text-danger">*</label>
                        {{ Form::text('month_end_date',null,['placeholder'=>'Month end date','id'=>'month_end_date','class' => 'form-control','required']) }}
                        {!! $errors->first('month_end_date', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ ($errors->has('holiday'))?'has-error':'' }}">
                        <label for="feature"> Holiday (In days)</label><label class="text-danger">*</label>
                        {{ Form::number('holiday',null,['placeholder'=>'','class' => 'form-control','required']) }}
                        {!! $errors->first('holiday', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ ($errors->has('leave'))?'has-error':'' }}">
                        <label for="feature"> Leave (In days)</label><label class="text-danger">*</label>
                        {{ Form::number('leave',null,['placeholder'=>'','class' => 'form-control','required']) }}
                        {!! $errors->first('leave', '<span class="text-danger">:message</span>') !!}
                    </div>

                </div>

                <div class="modal-footer justify-content-center">

                    <button type="submit"
                            class="btn btn-primary" name="submit" value="3">{{trans('app.save')}}</button>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                    <button type="button" class="btn btn-danger"
                            data-dismiss="modal">
                        {{trans('app.cancel')}}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>