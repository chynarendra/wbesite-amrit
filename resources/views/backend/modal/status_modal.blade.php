<div class="modal fade" id="statusModal{{$key}}">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title"></h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>[$page_url. '/'.'status/'.$data->id]]) !!}
            <div class="modal-body">
                @if($data->status == 1)
                    <input type="hidden" name="status" value="0">
                    <p>Are you sure you want to
                        inactive?</p>
                @else
                    <input type="hidden" name="status" value="0">
                    <p>Are you sure you want to active?</p>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit"
                        class="btn btn-primary">Yes
                </button> &nbsp; &nbsp;
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">No
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
