@extends('admin.main')

@section('extra-lib')
    {!! HTML::script('public/backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('public/backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ kết quả trên một trang",
                    "zeroRecords": "<div class='text-danger text-center'>Không có dữ liệu</div>",
                    "info": "Hiển thị trang số : _PAGE_  - Trong số : _PAGES_ trang",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
            //$('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript">
        function getFormInfo(id) {
            
            // $.ajax({
            //     url: '{!! route("admin.users.getForm") !!}',
            //     type: 'GET',
            // })
            // .done(function(output) {
                
            // })          
        }

        function postDelete(id){
        // console.log(id);
            $('#confirm').modal().one('click', '#delete', function(e){
                $.ajax({
                    url: '{!! route("admin.sizes.getDel") !!}',
                    type: 'GET',
                    data: {id : id},
                    success: function(output){
                    console.log(output);
                        $('.messages').html(output.description);
                        $('#getMessages').modal('toggle');
                        $('#tr_'+id).remove();
                    }
                });
            });
        }
    </script>

@stop

@section('extra-style')
    {!! HTML::style('public/backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Quản lý nhân viên</h3>
            <span class="pull-right">{!! HTML::link('#', 'Thêm mới', ['onClick' => 'getFormInfo()', 'class' => 'btn btn-block btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#getForm']) !!}</span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data))
                        @foreach($data as $key => $value)
                            <tr id="tr_{!! $value->id !!}">
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $value->name !!}</td>
                                <td>{!! $value->birthday !!}</td>
                                <td>{!! $value->phonenumber !!}</td>
                                <td class="text-center">
                                    @if(Auth::user()->level() == 1)
                                        @if($value->level() != 1)
                                            {!! HTML::decode(HTML::link('#', '<i class="fa text-danger fa-remove"></i>', ['onclick' => 'postDelete('.$value->id.')', 'data-toggle' => 'tooltip', 'title' => 'Xóa'])) !!}
                                        @endif

                                        {!! HTML::decode(HTML::link(route('admin.users.getEdit', ['id' => $value->id]), '<i class="fa text-primary fa-pencil-square-o"></i>'))!!}
                                    @elseif(Auth::user()->level() == 2)
                                        @if($value->id == Auth::user()->id)
                                            
                                            {!! HTML::decode(HTML::link(route('admin.users.getEdit', ['id' => $value->id]), '<i class="fa text-primary fa-pencil-square-o"></i>'))!!}
                                        @elseif($value->level() > 2)
                                            {!! HTML::decode(HTML::link('#', '<i class="fa text-danger fa-remove"></i>', ['onclick' => 'postDelete('.$value->id.')', 'data-toggle' => 'tooltip', 'title' => 'Xóa'])) !!}
                                            {!! HTML::decode(HTML::link(route('admin.users.getEdit', ['id' => $value->id]), '<i class="fa text-primary fa-pencil-square-o"></i>'))!!}
                                        @endif
                                    @else
                                        @if($value->id == Auth::user()->id)
                                            {!! HTML::decode(HTML::link(route('admin.users.getEdit', ['id' => $value->id]), '<i class="fa text-primary fa-pencil-square-o"></i>'))!!}
                                        @endif
                                    @endif
                              </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Chức Năng</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="getForm" tabindex="-1" role="dialog" aria-labelledby="PostFormLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!!Form::open(['url' => URL::route('admin.users.postForm'), 'method' => 'POST', 'id' => 'postForm', 'enctype'=>'multipart/form-data'])!!}
                <div class="modal-header" id="header-postForm">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="PostFormLabel">Dữ liệu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="description" style="color: rgb(0, 128, 0);">Thêm người dùng</div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên : </label>
                        {!!Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Họ và tên ...!'])!!}
                    </div>
                    <div class="form-group">
                        <label for="username">Tài khoản : </label>
                        {!!Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Tài khoản'])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Vị trí</label><br />
                        @foreach($role as $value)
                            @if(Auth::user()->level() <= $value->level)
                                <label class="radio-inline">
                                    {!! Form::radio('role', $value->id ,null, ['class' => '']) !!}  
                                    {!! $value->name !!}
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    {!!Form::submit('Lưu lại', ['class' => 'btn btn-primary', 'id' => 'submitForm'])!!}
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>

@stop