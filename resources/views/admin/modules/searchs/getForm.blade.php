@extends('admin.main')

@section('extra-lib')
    <script type="text/javascript">
        var data = 1;

        $(document).ready(function() {

            // Thêm giá 
            $('.addPrice').on('click', function() {
                var newData = eval(data) + eval(1);
                //var id_2 = newData + 1;
                var html = '<label>Giá từ <input type="number" name="price['+newData+'][]" class="form-control"></input> Đến <input type="number" name="price['+newData+'][]" class="form-control"></input></label>';
                data = eval(data) + 1;
                $('.append').append(html);
            });

            $('.delPrice').on('click', function() {
                $('.append label:last-child').remove();
            });

            // Thêm màu

            $('.addColor').on('click', function() {
                var select = '{!! Form::select("color[]", $colors, "", ["class" => "form-control size", "required" => "required"]) !!}';
                console.log(select);
                $('.appendColor').append(select);
            });

            // Xoá màu

            $('.delColor').on('click', function() {
                $('.appendColor select:last-child').remove();
            });

            // Thêm size

            $('.addSize').on('click', function() {
                var select = '{!! Form::select("size[]", $sizes, "", ["class" => "form-control size", "required" => "required"]) !!}';
                console.log(select);
                $('.appendSize').append(select);
            });

            // Xoá size

            $('.delSize').on('click', function() {
                $('.appendSize select:last-child').remove();
            });

            // Xoá thành phần tìm kiếm (giá, màu, size ..vv )

            $('.title span').on('click', function(event) {
                var getNameClass =  $(this).attr('id');
                $('.'+getNameClass).remove();
            });
        });
    </script>

@stop

@section('extra-style')
    <style type="text/css">
        p.add{
            color: #5A5AF9;
            font-size: 15px;
            text-decoration: underline;
            cursor: pointer;
        }
        p.title{
            font-weight: bold;
            font-size: 16px;
        }
        .title span{
            float: right;
            font-size: 14px !important;
            font-weight: normal;
            text-decoration: underline;
            cursor: pointer;
        }
        .append input{
            display: inline-block;
            width: 39%;
        }

        .append span{
            padding: 5%;
            display: inline-block;
        }
        span.padding-left{
            padding-left:0;
        }
        .color, .size{
            margin-bottom: 10px;
        }
    </style>
@stop

@section('content')
    {!! Form::open(['url' => route('admin.searchs.postForm')]) !!}
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Thiết lập tìm kiếm</h3>
            <span class="pull-right">{!! Form::submit('Lưu', ['class' => 'btn btn-block btn-primary']) !!}</span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Tiêu đề : </label>
                    <input type="text" name="name_search" class="form-control"  required="required">
                </div>
                 <div class="form-group">
                    <label>Danh mục : </label>
                    {!! Form::select('category_id', $categories, '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-4 _price">
                <p class="title">Thiết lập giá <span id="_price"><i class="fa text-danger fa-remove"></i></span></p>
                <div class="append">
                    <label>
                        Giá từ <input type="number" name="price[1][]" class="form-control"  required="required"> Đến <input type="number" name="price[1][]" class="form-control" required="required">
                    </label>
                </div>
                <p class="addPrice add">Thêm mới</p>
                <p class="delPrice add">Xoá</p>
            </div>

            <div class="col-sm-4 _color">
                <p class="title">Thiết lập màu <span id="_color"><i class="fa text-danger fa-remove"></i></span></p>
                <div class="selectColor">
                {!! Form::select('color[]', $colors, null, ['class' => 'form-control color', 'required' => 'required']) !!}
                </div>
                <p class="appendColor">
                    
                </p>
                <p class="addColor add">Thêm mới</p>
                <p class="delColor add">Xoá</p>
            </div>

            <div class="col-sm-4 _size">
                <p class="title">Thiết lập kích thước (size) <span id="_size"><i class="fa text-danger fa-remove"></i></span></p>
                <div class="selectSize">
                {!! Form::select('size[]', $sizes, null, ['class' => 'form-control size', 'required' => 'required']) !!}
                </div>
                <p class="appendSize">
                    
                </p>
                <p class="addSize add">Thêm mới</p>
                <p class="delSize add">Xoá</p>
            </div>
            
        </div>
        {!! Form::close() !!}
    </div>

    
@stop