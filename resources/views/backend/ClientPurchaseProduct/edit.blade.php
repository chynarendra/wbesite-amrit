<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">{{trans('app.edit')}} &nbsp;</h3>

    </div>
    <div class="card-body">

        {!! Form::model($purchaseProduct,['method'=>'PUT','route'=>['clientPurchaseProduct.update',[$appUserId,$clientDetail->id,$purchaseProduct->id]]]) !!}

        <div class="row">

            <div class="form-group {{ ($errors->has('product_id'))?'has-error':'' }}">
                <label> Product</label><label class="text-danger">*</label>
                {!! Form::select('product_id',$productList->pluck('product_name','id'),null,['style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Product
                ']) !!}
                {!! $errors->first('product_id', '<span class="text-danger">:message</span>') !!}
            </div>
            <div class="form-group {{ ($errors->has('purchase_office_id'))?'has-error':'' }}">
                <label> Purchase Office</label><label class="text-danger">*</label>
                {!! Form::select('purchase_office_id',$officeList->pluck('office_name','id'),null,['style' => 'width:100%','class'=>'form-control select2','placeholder'=>'Please Select Office
                ']) !!}
                {!! $errors->first('purchase_office_id', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group {{ ($errors->has('purchase_date'))?'has-error':'' }}">
                <label for="feature">Purchase Date</label><label class="text-danger">*</label>
                {{ Form::text('purchase_date',null,['placeholder'=>'Purchase date','class' => 'form-control purchaseDate','id'=>'purchaseDate','autocomplete'=>'off','readonly']) }}
                {!! $errors->first('purchase_date', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group {{ ($errors->has('paid_amount'))?'has-error':'' }}">
                <label for="feature">Paid Amount</label><label class="text-danger">*</label>
                {{ Form::number('paid_amount',null,['placeholder'=>'Paid amount','class' => 'form-control','id'=>'purchaseDate','autocomplete'=>'off']) }}
                {!! $errors->first('paid_amount', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group {{ ($errors->has('remarks'))?'has-error':'' }}">
                <label for="feature">Remarks</label>
                {{ Form::textarea('remarks',null,['placeholder'=>'Write Down','class' => 'form-control']) }}
                {!! $errors->first('remarks', '<span class="text-danger">:message</span>') !!}
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">
                    {{trans('app.update')}}
                </button>
            </div>

        </div>

        {!! Form::close() !!}


    </div>
    <!-- /.card-body -->
</div>