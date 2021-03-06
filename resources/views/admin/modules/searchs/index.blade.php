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

        function postDelete(id){
        // console.log(id);
            $('#confirm').modal().one('click', '#delete', function(e){
                var token = '{!! csrf_token() !!}'
                $.ajax({
                    url: '{!! route("admin.searchs.postDel") !!}',
                    type: 'POST',
                    data: {id : id, '_token' : token},
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
            <h3 class="box-title">Quản lý danh mục</h3>
            <span class="pull-right">{!! HTML::link(route('admin.searchs.getForm', ['id' => 0]), 'Thêm mới', ['onClick' => 'getFormInfo()', 'class' => 'btn btn-block btn-primary']) !!}</span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name search</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data))
                        @foreach($data as $key => $value)
                            <tr id="tr_{!! $value->id !!}">
                                <td> {!! $key + 1 !!}</td>
                                <td>{!! $value->name_search !!}</td>
                                <td class="text-center">
                                  {!! HTML::decode(HTML::link('#', '<i class="fa text-danger fa-remove"></i>', ['onclick' => 'postDelete('.$value->id.')', 'data-toggle' => 'tooltip', 'title' => 'Xóa'])) !!}

                                  {!! HTML::decode(HTML::link(route('admin.searchs.getEdit', ['id' => $value->id]), '<i class="fa text-primary fa-pencil-square-o"></i>'))!!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name search</th>
                        <th>Chức Năng</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    
@stop