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
            if(typeof(id) == 'undefined') {
                id = '';
            }
           // console.log(id);
            $.ajax({
                url: '{!! route("admin.sizes.getForm") !!}?id='+id,
                type: 'GET',
            })
            .done(function(output) {
                console.log(output);
                if(typeof(output.data) == 'undefined'){
                    if ($('input[name=id]').length) {
                        $('input[name=id]').remove();
                    }
                   
                    $('#size').val('');
                    $('.description').html(output.description).css('color', 'green');
                } else {
                    if ($('input[name=id]').length) {
                        $('input[name=id]').val(output.data.id);
                    } else {
                        $('#header-postForm').append('<input type="hidden" name="id" value="' + output.data.id + '" id="id" >');
                    }
                  
                    $('.description').html(output.description).css('color', 'rgb(255, 179, 0)');
                    $('#size').val(output.data.size);
                    $('.category_id').val(output.cate);
                }
            })          
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
            <h3 class="box-title">Quản lý danh mục</h3>
            <span class="pull-right">{!! HTML::link('#', 'Thêm mới', ['onClick' => 'getFormInfo()', 'class' => 'btn btn-block btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#getForm']) !!}</span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kích thước (size)</th>
                        <th>Danh mục</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($data))
                        @foreach($data as $key => $value)
                            <tr id="tr_{!! $value->id !!}">
                                <td> {!! $key + 1 !!}</td>
                                <td>{!! $value->size !!}</td>
                                <td>
                                    {!! $value->categories->name_category !!}
                                </td>
                                <td class="text-center">
                                  {!! HTML::decode(HTML::link('#', '<i class="fa text-danger fa-remove"></i>', ['onclick' => 'postDelete('.$value->id.')', 'data-toggle' => 'tooltip', 'title' => 'Xóa'])) !!}

                                  {!! HTML::decode(HTML::link('#', '<i class="fa text-primary fa-pencil-square-o"></i>', ['onClick' => 'getFormInfo('.$value->id.')', 'data-toggle'=>'modal', 'data-target'=>'#getForm']))!!}
                              </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Kích thước (size)</th>
                        <th>Danh mục</th>
                        <th>Chức Năng</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="getForm" tabindex="-1" role="dialog" aria-labelledby="PostFormLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!!Form::open(['url' => URL::route('admin.sizes.postForm'), 'method' => 'POST', 'id' => 'postForm', 'enctype'=>'multipart/form-data'])!!}
                <div class="modal-header" id="header-postForm">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="PostFormLabel">Dữ liệu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="description"></div>
                    </div>
                    <div class="form-group">
                        <label for="size">Kích thước (size)</label>
                        {!!Form::text('size', null, ['class' => 'form-control', 'id' => 'size', 'placeholder' => 'Tên kích thước (size)'])!!}
                    </div>
                    <div class="form-group">
                        <label for="category_id">Phân cấp</label>
                        {!! Form::select('category_id', $category, null, ['class' => 'form-control category_id']) !!}
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