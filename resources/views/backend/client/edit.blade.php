<div class="modal fade" id="editModal{{$key}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title">{{trans('app.edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($data,['method'=>'PUT','route'=>[$page_route.'.'.'update',$data->id],'enctype'=>"multipart/form-data"]) !!}
                        <div class="form-group  {{ ($errors->has('name'))?'has-error':'' }}">
                            <label>Name</label> <label class="text text-danger"> *</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
                            {!! $errors->first('name', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group  {{ ($errors->has('logo'))?'has-error':'' }}">
                            <label>Logo</label>
                            <input type="file" name="logo" />
                            {!! $errors->first('logo', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('app.status')}} </label><br>
                            <div class="icheck-success d-inline">
                                <input type="radio" id="radio{{$key}}" name="status" value="1" <?php echo $data->status == '1' ? 'checked' : '' ?>>
                                <label for="radio{{$key}}">
                                    {{trans('app.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio" id="radio{{++$key}}" name="status" value="0" <?php echo $data->status == '0' ? 'checked' : '' ?>>
                                <label for="radio{{$key}}">
                                    {{trans('app.inactive')}}
                                </label>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-center">

                            <button type="submit" class="btn btn-primary">{{trans('app.save')}}</button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
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