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
                    <div class="col-md-12">

                        {!! Form::model($data,['method'=>'PUT','route'=>['type.update',$data->id]]) !!}
                        <div class="form-group">
                            <label for="inputName">{{trans('app.name')}}</label>
                            {!! Form::text('type_name',null,['class'=>'form-control','placeholder'=>'Enter User Type  Name','autocomplete'=>'off']) !!}
                            {!! $errors->first('type_name', '<small class="text text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {{ ($errors->has('details'))?'has-error':'' }}">
                            <label for="inputDescription">{{trans('app.details')}}</label>
                            {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Enter User Type Description','rows'=>'4','autocomplete'=>'off']) !!}
                            {!! $errors->first('details', '<span class="label label-danger">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="status">{{trans('app.status')}} </label><br>
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio1"
                                       name="status" value="1"
                                       @if($data->status=='1') checked @endif>
                                <label for="readio1">
                                    {{trans('app.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio2"
                                       name="status"
                                       value="0"   @if($data->status=='0') checked @endif>
                                <label for="readio2">
                                    {{trans('app.inactive')}}
                                </label>
                            </div>

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
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>