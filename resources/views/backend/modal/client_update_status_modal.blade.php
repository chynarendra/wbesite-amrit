<div class="modal fade" id="updateStatusModal{{$count}}">
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
                            ->where('id', '<>', $client->status)
                            ->get();
                        ?>

                        {!! Form::open(['method'=>'post','url'=>'/dsr/changestatus']) !!}
                        <input type="hidden" name="client_id" value="{{$client->id}}">
                        <div class="form-group">
                            <label for="inputName">{{trans('Status Name')}}</label> <label class="text-danger">*</label>
                            {!! Form::select('status_id',$updateStatusList->pluck('name','id'),null,['style' => 'width:100%','class'=>'form-control select2 status_id','placeholder'=>'Please Select Status','required']) !!}

                            {!! $errors->first('status_id', '<small class="text text-danger">:message</small>') !!}
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