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
    <!-- jQuery  -->
        
    <script type="text/javascript">
        $(document).ready(function() {
           // $('#category_id').prepend('<option value="" selected="selected"> -- Chọn danh mục -- </option>');
            // $('.newColor').on('click', function(event) {
            //    console.log( $(this).parent());
            // });
            
        });
        // $('.color').change(function(event) {
        //     console.log($(this).val());
        // });
    </script>

    <!-- Ajax function delete  -->
    <script type="text/javascript">

        function postDelete(id){
        // console.log(id);
            $('#confirm').modal().one('click', '#delete', function(e){
                $.ajax({
                    url: '{!! route("admin.parameters.getDel") !!}',
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
    <!-- Ajax load parameter and size  -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('select[name=category_id]').change(function(event) {
                $('.detail').html('');
                var category_id = $(this).val();
                var token = '{!! csrf_token() !!}';
                $('.table').html('{!! HTML::image('public/backend/images/loading.gif', '', ["style" => "margin-left :45%; width: 70px"]) !!}');
                $.ajax({
                    url: '{!! route("admin.products.postCategories") !!}',
                    type: 'POST',
                    data: {category_id: category_id, _token : token},
                })
                .done(function(output) {
                    
                    $('.table').html(output);
                })                
            });
        });
    </script>

    <!-- Function add color and size  -->

    <script type="text/javascript">
        // Add Color
       function addColor() {
            var html = $('#listColor .firstColor .item:nth-child(1)').html();
            $('#listColor').append(html)
        }

        function newColor() {
            var html = $('#newColor .firstColor .item:nth-child(1)').html();
            $('#newColor').append(html);
        }

        // Add size

        function addSize() {
            var html = $('#firstSize .item:nth-child(1)').html();
           console.log(html);
            $('.list-size').append(html);
        }

    </script>

@stop

@section('extra-style')
    {!! HTML::style('public/backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop

@section('content')
    {!! Form::open(['url' => route('admin.products.postFormAdd'), 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'postForm']) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm sản phẩm</h3>
            <span class="pull-right">
                {!! Form::submit('Thêm', ['class' => 'btn btn-block btn-primary']) !!}
            </span>
        </div><!-- /.box-header -->
        <div class="box-body">

            <div style="width:48%; padding-right: 2%; float: left;">
                <div class="form-group">
                    <label for="name_product">Tên sản phẩm</label>
                    <input type="text" name="name_product" class="form-control" id="name_product" placeholder="Tên sản phẩm">
                </div>

                <div class="form-group">
                    <label for="images">Hình ảnh</label>
                    <input type="file" name="images[]" id="images" multiple="multiple" />
                    <p class="help-block">Vui lòng chọn hình ảnh để hiển thị</p>
                </div>

                <div class="form-group">
                    <label for="value">Số lượng</label>
                    <input type="number" name="value" class="form-control" id="value" placeholder="Nhập số lượng sản phẩm">
                </div>

                <div style="width:50%; padding-right: 2%; float: left;">
                    <div class="form-group">
                        <label for="price_real">Giá mua vào</label>
                        <input type="number" name="price_real" class="form-control" id="price_real" placeholder="Nhập giá mua vào">
                    </div>
                </div>

                <div style="width:50%; float: left;">
                    <div class="form-group">
                        <label for="price_buy">Giá bán ra</label>
                        <input type="number" name="price_buy" class="form-control" id="price_buy" placeholder="Nhập giá bán ra">
                    </div>
                </div>

                <div class="form-group">
                    <label for="color">Màu</label>
                    <div id="listColor">
                        <div class="firstColor">
                            <div class="item">
                                {!! Form::select('color[]', $color, null, ['class' => 'form-control color']) !!}
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="addColor"></div>
                <p onclick="addColor()" style="text-decoration: underline;color: #3c8dbc; cursor: pointer;">Thêm màu</p>

                <div class="form-group">
                    <label for="color"> (*) Thêm màu chưa có trong danh sách</label>
                    <div id="newColor">
                        <div class="firstColor">
                            <div class="item">
                                {!! Form::text('color[]', null, ['class' => 'form-control color']) !!}
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="newColor"></div>
                <p onclick="newColor()" style="text-decoration: underline;color: #3c8dbc; cursor: pointer;">Thêm màu</p>

            </div>

            <div style="width:50%; float: left;">

                <div class="form-group">
                    <label for="category_id">Danh mục sản phẩm</label>
                    {!! $categories !!}
                </div>

                <div class="form-group">
                    <label>Chi tiết sản phẩm</label>
                     <p class="detail"> - Hãy chọn danh mục</p>
                </div>

                <div class="table">
                    <div class="form-group">
                        <label>Kích thước (size)</label>
                        <p> - Hãy chọn danh mục</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview">Mô tả sản phẩm</label>
                    {!! Form::textarea('preview', null, ['class' => 'form-control', 'id' => 'preview', 'placeholder' => 'Nhập mô tả sản phẩm']) !!}
                </div>

            </div>
            
        </div>
    </div>
    {!! Form::close() !!}
@stop