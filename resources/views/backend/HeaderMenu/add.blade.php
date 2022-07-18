<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #6c757d">
                <h4 class="modal-title">{{trans('app.add')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>

            {!! Form::open(['method'=>'post','url'=>$page_url]) !!}

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group  {{ ($errors->has('name'))?'has-error':'' }}">
                            <label>Name</label> <label class="text text-danger"> *</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Menu name','required'=>'required']) !!}
                            {!! $errors->first('name', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ ($errors->has('parent_menu_id'))?'has-error':'' }}">
                            <label for="parent_menu_id">Parent Menu </label>
                            {{Form::select('parent_menu_id',$parentMenus->pluck('name','id'),Request::get('parent_menu_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                    'Select Parent Menu'])}}
                            {!! $errors->first('parent_menu_id', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ ($errors->has('menu_type'))?'has-error':'' }}">
                            <label for="menu_type">Menu Type </label><label class="text text-danger"> *</label>
                            {{Form::select('menu_type',$data['menu_type'],Request::get('menu_type'),['class'=>'form-control select2','id'=>'menuType','style'=>'width: 100%;','placeholder'=>
                                                                    'Select Menu Type','required'=>'required'])}}
                            {!! $errors->first('menu_type', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6" id="module" style="display: none;">
                        <div class="form-group {{ ($errors->has('module_url'))?'has-error':'' }}">
                            <label for="module_url">Module</label>
                            {{Form::select('module_url',$modules,Request::get('module_url'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                    'Select Module'])}}
                            {!! $errors->first('module_url', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6" id='page' style="display: none;">
                        <div class="form-group {{ ($errors->has('page_url'))?'has-error':'' }}">
                            <label for="page_url">Page</label>
                            {{Form::select('page_url',$pages->pluck('title','slug'),Request::get('page_url'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                                    'Select Page'])}}
                            {!! $errors->first('page_url', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6" id="externalUrl" style="display: none;">
                        <div class="form-group  {{ ($errors->has('external_url'))?'has-error':'' }}">
                            <label>External Url</label>
                            {!! Form::text('external_url',null,['class'=>'form-control','placeholder'=>'Menu external url']) !!}
                            {!! $errors->first('external_url', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group  {{ ($errors->has('display_order'))?'has-error':'' }}">
                            <label>Display Order</label>
                            {!! Form::number('display_order',null,['class'=>'form-control','placeholder'=>'order']) !!}
                            {!! $errors->first('display_order', '<span class="text text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">{{trans('app.status')}} </label><br>
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio3" name="status" value="active" checked>
                                <label for="readio3">
                                    {{trans('app.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio" id="readio4" name="status" value="inactive">
                                <label for="readio4">
                                    {{trans('app.inactive')}}
                                </label>
                            </div>

                        </div>
                    </div>
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>