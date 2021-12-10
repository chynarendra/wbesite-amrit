<div class="modal fade" id="updateStatusModal{{$key}}">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header btn-secondary">
                <h4 class="modal-title">Update Status</h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['leaves/status']]) !!}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{$leave->id}}" />
                <select name="status" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status}}" <?php echo ($status==$leave->status)?'selected':''; ?> >{{$status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit"
                        class="btn btn-primary">Update
                </button> &nbsp; &nbsp;

            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
