<div class="modal fade" id="updateStatusModal{{$key}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <h4 class="modal-title">{{trans('Are you sure you want to update status?')}}</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $updateStatusList = '';
                        $updateStatusList = \Illuminate\Support\Facades\DB::table('customer_status')
                            ->where('id', '<>', $data->status)
                            ->get();
                        ?>

                        {!! Form::open(['method'=>'post','url'=>'customerUpdateStatus']) !!}
                        <input type="hidden" name="customer_id" value="{{$data->id}}">
                        <div class="form-group">
                            <label for="inputName">{{trans('Status Name')}}</label> <label class="text-danger">*</label>
                            {!! Form::select('status_id',$updateStatusList->pluck('name','id'),null,['style' => 'width:100%','class'=>'form-control select2 status_id','placeholder'=>'Please Select Status','required']) !!}

                            {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group followup-date {{ ($errors->has('details'))?'has-error':'' }}">
                            <label for="inputDescription">{{trans('Follow Up Date')}}</label>
                            {{ Form::text('followup_date',null,['placeholder'=>' Followup Date','autocomplete'=>'off','class' => 'form-control followDate','readonly']) }}
                            {!! $errors->first('followup_date', '<span class="text-danger">:message</span>') !!}
                        </div>
                     {{--   <div  id="product_form" style="display: none">
                            <hr>
                            <div class="form-group col-md-12">
                                <h3  class="text text-primary" style="font-size: 18px; text-align: center"> {{trans('Product Add Area')}}</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Product</label> <label class="text-danger">*</label>
                                <div class="select2-blue">
                                    <select class="select2" multiple="multiple" data-placeholder="Select Products"  name="product_id[]"  id="addProduct"  style="width: 100%; height: 200px;" autocomplete="off">
                                        @foreach($productList as $data)
                                            <option class='form control' value='{{ $data->id }}'  {{ old('product_id') == $data->id ? "selected" :""}} >
                                                {{ $data->product_name  }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr/>--}}
                        <div class="form-group {{ ($errors->has('remarks'))?'has-error':'' }}">
                            <label for="inputDescription">{{trans('app.details')}}</label>
                            {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Enter  Remarks','rows'=>'4','autocomplete'=>'off']) !!}
                            {!! $errors->first('remarks', '<span class="label label-danger">:message</span>') !!}
                        </div>


                        <div class="modal-footer justify-content-center">

                            <button type="submit"
                                    class="btn btn-success">{{trans('app.update')}}</button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">
                                {{trans('app.cancel')}}
                            </button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>