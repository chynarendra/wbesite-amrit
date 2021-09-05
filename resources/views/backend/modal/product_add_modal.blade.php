
<div class="modal fade" id="productAddModal">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title">{{trans('Add New Product')}}</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'post','url'=>'product','autocomplete'=>'off']) !!}
                <div class="row">
                    <div class="form-group col-md-6 {{ ($errors->has('campaign_id'))?'has-error':'' }}">
                        <label>Campaign</label><label class="text-danger">*</label>
                        {!! Form::select('campaign_id',$campaignList->pluck('campaign_name','id'),null,['id' => 'campaignId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Campaign
                        ','required']) !!}
                        {!! $errors->first('campaign_id', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ ($errors->has('product_category_id'))?'has-error':'' }}">
                        <label>Category</label><label class="text-danger">*</label>
                        {!! Form::select('product_category_id',$productCategoryList->pluck('name','id'),null,['id' => 'categoryId','style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Product Category
                        ','required']) !!}
                        {!! $errors->first('product_category_id', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6 {{ ($errors->has('product_name'))?'has-error':'' }}">
                        <label for="feature">Name</label><label class="text-danger">*</label>
                        {{ Form::text('product_name',null,['placeholder'=>'Product Name','class' => 'form-control','required']) }}
                        {!! $errors->first('product_name', '<span class="text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ ($errors->has('warrenty_in_years'))?'has-error':'' }}">
                        <label for="feature"> Warranty In Years</label><label class="text-danger">*</label>
                        {{ Form::text('warrenty_in_years',null,['placeholder'=>'Example: 2 years','class' => 'form-control','required']) }}
                        {!! $errors->first('warrenty_in_years', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-12 {{ ($errors->has('about_product'))?'has-error':'' }}">
                        <label for="feature">Product Details</label>
                        {{ Form::textarea('about_product',null,['placeholder'=>'','class' => 'textarea', 'style' => 'width: 100%; height: 34opx; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; cols: 300;']) }}
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