<!-- get popup messages -->
<div class="modal fade" id="getMessages" tabindex="-1" role="dialog" aria-labelledby="MessagesLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="PermissionLabel">Thông báo</h4>
            </div>
            <div class="modal-body">
                <p class="messages">
                    @if(\Session::has('messages'))
                        {!! \Session::get('messages') !!}
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

@if(\Session::has('messages'))
    <script>
        $(document).ready(function(){
            $('#getMessages').modal('toggle');
        });
    </script>
@endif