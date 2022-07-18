<div class="modal fade" id="editModal">
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
                    {!! Form::model($value,['method'=>'PUT','route'=>[$page_route.'.'.'update',$value->id],'enctype'=>"multipart/form-data"]) !!}
                    <div class="col-md-12">
                        <div class="form-group  {{ ($errors->has('title'))?'has-error':'' }}">
                            <label>Title</label> <label class="text text-danger"> *</label>
                            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Title']) !!}
                            {!! $errors->first('title', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group  {{ ($errors->has('subtitle'))?'has-error':'' }}">
                            <label>Subtitle</label> 
                            {!! Form::text('subtitle',null,['class'=>'form-control','placeholder'=>'Subtitle']) !!}
                            {!! $errors->first('subtitle', '<span class="text text-danger">:message</span>') !!}
</div>

                        <div class="form-group  {{ ($errors->has('video'))?'has-error':'' }}">
                            <label>video</label> 
                            {!! Form::file('video',null,['class'=>'form-control','placeholder'=>'video']) !!}
                            {!! $errors->first('video', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group {{ ($errors->has('content'))?'has-error':'' }}">
                            <label>Content </label>

                            <textarea name="content" id="summernote2">
                            {!! $value->content !!}
                                </textarea>

                            {!! $errors->first('content', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('app.status')}} </label><br>
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio3" name="status" value="1" checked>
                                <label for="readio3">
                                    {{trans('app.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio4" name="status" value="0">
                                <label for="readio4">
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

                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>