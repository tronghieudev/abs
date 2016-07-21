@extends('admin.main')

@section('extra-style')
	{!! HTML::style('public/backend/plugins/datepicker/datepicker3.css') !!}
	
	<style type="text/css">
		.img{
   			min-height: 300px;
    position: relative;
    margin-bottom: 10px;
		}
		.img img{
			    display: block;
    margin: auto;
    height: 300px;
    width: 100%;
		}
		.img p{
			margin: 0;
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    padding: 10px 20px;
    background: rgba(0, 0, 0, 0.62);
    cursor: pointer;
    vertical-align: middle;
    display: block;
    color: #fff;
		}
		.img p i{
			    font-size: 25px;
    color: rgba(255, 255, 255, 0.76);
    display: inline-block;
    vertical-align: middle;
    padding-right: 15px;
		}
		.col-sm-8 h2 {
			    font-size: 20px;
    margin: 0;
		}
		.list-info {
			padding: 0;
    margin-top: 15px;
		}

		.list-info li {
			list-style: none;
			    padding-bottom: 10px;
		}

		.list-info li span{
    font-size: 14px;
    font-weight: 600;
    padding-right: 20px;    width: 20%;
    display: inline-block;
		}
		.list-info li input{
			    width: 250px;
    padding: 4px;
    border-radius: 4px;
    border: 1px solid #ccc;
		}
	</style>
@endsection

@section('extra-lib')
	{!! HTML::script('public/backend/plugins/datepicker/bootstrap-datepicker.js') !!}
	<script type="text/javascript">
		$(document).ready(function() {

			// validate
            $('#changePass').bootstrapValidator({
                message: 'Yêu cầu hoàn thành đầy đủ thông tin',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    old_pass: {
                        validators: {
                            notEmpty: {
                                message: 'Không được để trống trường này'
                            }

                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Không được để trống trường này'
                            }

                        }
                    },
                    re_password: {
                        validators: {
                            notEmpty: {
                                message: 'Không được để trống trường này'
                            },
                            identical: {
                            	field : 'password',
                            	message: 'Xác nhận mật khẩu không đúng'
                            }
                        }
                    },
                }
            });

			$('#datepicker').datepicker({
		      autoclose: true
		    });

		    // ajax update info

		    $('#update').on('click', function () {
		    	var token = '{!! csrf_token() !!}';
		    	var name = $('input[name=name]').val();
		    	var email = $('input[name=email]').val();
		    	var birthday = $('input[name=birthday]').val();
		    	var cmnd = $('input[name=cmnd]').val();
		    	var phonenumber = $('input[name=phonenumber]').val();
		    	//console.log(name +' - '+ email +' - '+birthday +' - '+cmnd +' - '+phonenumber);
		    	$.ajax({
		    		url: '{!! route('admin.users.postEdit', ['id' => $data->id]) !!}',
		    		type: 'POST',
		    		data: {name: name , email: email , birthday: birthday , cmnd: cmnd , phonenumber: phonenumber, _token : token},
		    	})
		    	.done(function(output) {
		    		if(output.code == 200){
			    		$('.des').prepend("<p style='color: #019601;background: rgba(73, 173, 85, 0.45);padding: 5px 10px;'>"+output.description+"</p>");
			    	}else{
			    		$('.des').prepend("<p style='color: #960101;background: rgba(173, 73, 73, 0.45);padding: 5px 10px;'>"+output.description+"</p>");
			    	}
		    	})
		    });
		});
	</script>

@endsection

@section('content')
	<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin nhân viên</h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
            	<div class="col-sm-4">
            		<div class="img">
            			@if(!empty($data->image))
            				{!! HTML::image('public/multimedia/images/users/'.$data->image, '', ['class' => 'img-responsive']) !!}
            			@else
            				Chưa có hình ảnh
            			@endif
            			<p data-toggle='modal' data-target='#getForm'><i class="glyphicon glyphicon-camera"></i> Cập nhật ảnh đại diện</p>
            		</div>
            		<div class="pass">
            			{!! Form::open(['url' => route('admin.users.postPass', ['id' => $data->id]), 'id' => 'changePass']) !!}
            				<div class="form-group">
						    	<label for="exampleInputEmail1">Mật khẩu cũ</label>
						    	{!! Form::password('old_pass', ['class' => 'form-control']) !!}
						  	</div>
						  	<div class="form-group">
						    	<label for="exampleInputEmail1">Mật khẩu mới</label>
						    	{!! Form::password('password', ['class' => 'form-control']) !!}
						  	</div>
						  	<div class="form-group">
						    	<label for="exampleInputEmail1">Xác nhận mật khẩu mới</label>
						    	{!! Form::password('re_password', ['class' => 'form-control']) !!}
						  	</div>
						  	{!! Form::submit('Đổi mật khẩu', ['class' => 'btn btn-primary pull-right']) !!}
            			{!! Form::close() !!}
            		</div>
            	</div>
            	<div class="col-sm-8">
            		<h2>Thông tin cá nhân : </h2>
            		{!! Form::open(['url' => '', 'id' => 'info']) !!}
	            		<ul class="list-info">
	            			<li>
	            				<span>Họ tên : </span>
	            				{!! Form::text('name', $data->name) !!}
	            			</li>
	            			<li>
	            				<span>Email : </span>
	            				{!! Form::email('email', $data->email) !!}
	            			</li>
	            			<li class="date">
	            				<span>Ngày sinh : </span>
	            				<?php
	            			
									$time = strtotime($data->birthday);
									
								?>
	            				{!! Form::text('birthday', date('m/d/Y', $time), ['id' => 'datepicker']) !!}
	            			</li>
	            			<li>
	            				<span>Số CMND : </span>
	            				{!! Form::text('cmnd', $data->cmnd) !!}
	            			</li>
	            			<li>
	            				<span>Số điện thoại : </span>
	            				{!! Form::text('phonenumber', $data->phonenumber) !!}
	            			</li>
	            			<li class="des">
	            				<span></span>
	            				<button type="button" class="btn btn-primary" id="update">Cập nhật</button>
	            			</li>
	            		</ul>
            		{!! Form::close() !!}
            	</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="getForm" tabindex="-1" role="dialog" aria-labelledby="PostFormLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!!Form::open(['url' => URL::route('admin.users.postImg', ['id' => $data->id]), 'method' => 'POST', 'id' => 'postForm', 'enctype'=>'multipart/form-data'])!!}
                <div class="modal-header" id="header-postForm">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="PostFormLabel">Dữ liệu</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
					    <label for="exampleInputFile">Chọn ảnh đại diện</label>
					    <input type="file" name="avata" id="exampleInputFile">
					    <p class="help-block"></p>
				  	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    {!!Form::submit('Cập nhật', ['class' => 'btn btn-primary', 'id' => 'submitForm'])!!}
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@endsection