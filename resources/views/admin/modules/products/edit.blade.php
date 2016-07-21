@extends('admin.main')

@section('extra-style')
    <style type="text/css">
        .mng {
            text-decoration: underline;
            color: #3c8dbc;
            cursor: pointer;
            display: inline-block;
        }
        .item-img {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            position: relative;
        }
        .item-img div {
            position: absolute;
            background: #000;
            opacity: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            transition: all ease-in .3s;
        }
        .item-img i {
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
            background: #000;
            color: #FFF;
            opacity: 0;
            transition: all ease-in .3s;
            cursor: pointer;
        }
        .item-img:hover div {
            opacity: 0.5;
        }
        .item-img:hover i {
            opacity: 1;
        }
    </style>
@stop
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
            //$('#category_id').prepend('<option value=""> -- Chọn danh mục -- </option>');
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

    <!-- Setting Images -->

    <script type="text/javascript">
        function setImage(key) {
            var id = {!! $product->id !!};
            $.ajax({
                url: '{!! route('admin.products.getSetImage') !!}',
                type: 'GET',
                data: {id: id, key : key},
            })
            .done(function(output) {
                if(typeof(output.code) != 'underfined' ) {
                    $('.img-'+key).remove();
                    $('.messages').html(output.description);
                    $('#getMessages').modal('toggle');
                }else{
                    $('.messages').html(output.description);
                    $('#getMessages').modal('toggle');
                }
            })
        }
    </script>

@stop

@section('extra-style')
    {!! HTML::style('public/backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop

@section('content')
    {!! Form::open(['url' => route('admin.products.postFormEdit', ['id' => $product->id]), 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'postForm']) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm sản phẩm</h3>
            <span class="pull-right">
                {!! Form::submit('Cập nhập', ['class' => 'btn btn-block btn-primary']) !!}
            </span>
        </div><!-- /.box-header -->
        <div class="box-body">

            <div style="width:48%; padding-right: 2%; float: left;">
                <div class="form-group">
                    <label for="name_product">Tên sản phẩm</label>
                    <input type="text" name="name_product" value="{!! $product->name_product !!}" class="form-control" id="name_product" placeholder="Tên sản phẩm">
                </div>

                <div class="form-group">
                    <label for="images">Hình ảnh</label>
                    <input type="file" name="images[]" id="images" multiple="multiple" />
                    <p class="help-block">Chọn để thêm hình ảnh</p>
                    <p class="mng" data-toggle="modal" data-target="#myModal">Quản lý hình ảnh</p>
                </div>

                <div class="form-group">
                    <label for="value">Số lượng</label>
                    <input type="number" name="value" value="{!! $product->value !!}" class="form-control" id="value" placeholder="Nhập số lượng sản phẩm">
                </div>

                <div style="width:50%; padding-right: 2%; float: left;">
                    <div class="form-group">
                        <label for="price_real">Giá mua vào</label>
                        <input type="number" name="price_real" value="{!! $product->price_real !!}" class="form-control" id="price_real" placeholder="Nhập giá mua vào">
                    </div>
                </div>

                <div style="width:50%; float: left;">
                    <div class="form-group">
                        <label for="price_buy">Giá bán ra</label>
                        <input type="number" name="price_buy" value="{!! $product->price_buy !!}" class="form-control" id="price_buy" placeholder="Nhập giá bán ra">
                    </div>
                </div>

                <div class="form-group">
                    <label for="color">Màu</label>
                    <div id="listColor">
                        <div class="firstColor">
                            
                            @if(count($product->colors))
                                @foreach($product->colors as $value)
                                    <div class="item">
                                        {!! Form::select('color[]', $colors, $value->id, ['class' => 'form-control color']) !!}
                                        <p></p>
                                    </div>
                                @endforeach
                            @else
                                <div class="item">
                                    {!! Form::select('color[]', $colors, 0, ['class' => 'form-control color']) !!}
                                    <p></p>
                                </div>
                            @endif
                           
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
                </div>

                <div class="table">
                    @if(!empty($parameters))
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th width="10%">STT</th>
                                    <th width="30%">Thông số</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parameters as $key => $value)
                                    <tr>
                                        <th scope="row">{!! $key + 1 !!}</th>
                                        <td>{!! $value->name_parameter !!}</td>
                                        <td>
                                            @if(array_key_exists($value->id, $parametersData))
                                                {!! Form::input('text', 'parameter['.$value->id.']', $parametersData[$value->id], ['class' => 'form-control']) !!}
                                            @else
                                                {!! Form::input('text', 'parameter['.$value->id.']', null, ['class' => 'form-control']) !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(!empty($sizes))
                        <div class="form-group list-size">
                            <label for="size">Kích thước (size)</label>
                            <div id="firstSize">
                                @if(count($product->sizes))
                                    @foreach($product->sizes as $value)
                                        <div class="item">
                                            {!! Form::select('size[]', $sizes, $value->id, ['class' => 'form-control size']) !!}
                                            <p></p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        {!! Form::select('size[]', $sizes, 0, ['class' => 'form-control size']) !!}
                                        <p></p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <p onclick="addSize()" style="text-decoration: underline;color: #3c8dbc; cursor: pointer;">Thêm kích thước (size)</p>

                    @endif
                </div>

                <div class="form-group">
                    <label for="preview">Mô tả sản phẩm</label>
                    {!! Form::textarea('preview', $product->preview, ['class' => 'form-control', 'id' => 'preview', 'placeholder' => 'Nhập mô tả sản phẩm']) !!}
                </div>

            </div>
            
        </div>
    </div>
    {!! Form::close() !!}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog"  style="width:750px">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quản lý hình ảnh</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $arrImage = json_decode($product->images, true);
                       // print_r($arrImage);
                    ?>
                    @foreach($arrImage as $key => $value)
                        <div class="col-sm-4 img-{!! $key !!}">
                            <div class="item-img ">
                                <div></div>
                                {!! HTML::image('public/multimedia/images/products/'.$value, $value, ['onclick' => 'setImage('.$key.')', 'class' => 'img-responsive']) !!}
                                <i class="fa text-danger fa-remove" onclick="setImage({!! $key !!})"></i>
                            </div>
                        </div>
                        
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop