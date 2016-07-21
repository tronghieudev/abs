@extends('public.main')


@section('content')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					{!! Breadcrumbs::render('order') !!}
				</div>
			</div>
		</div>
	</div>

	<section class="main-container col1-layout">
		<div class="main container">
			<div class="col-main">

				<section class="col-sm-9 wow bounceInUp animated">
        			<div class="col-main">
        				<?php
        					$carts = session()->get('cart');
        				?>
        				@if(isset($carts))
        				{!! Form::open(['url' => route('public.orders.postForm'), 'method' => 'POST']) !!}
        					<div class="form-group">
        						<label>
        							Họ tên : 
        						</label>
        						<input class="form-control" name="address_name" type="text" placeholder="Nhập họ tên">
        					</div>
        					<div class="form-group">
        						<label>
        							Địa chỉ : 
        						</label>
        						<input class="form-control" name="name" type="text" placeholder="Nhập địa chỉ">
        					</div>
        					<div class="form-group">
        						<label>
        							Số điện thoại : 
        						</label>
        						<input class="form-control" name="phone_number" type="number" placeholder="Nhập số điện thoại">
        					</div>
        					<div class="form-group">
        						<label>
        							Email : 
        						</label>
        						<input class="form-control" name="email" type="text" placeholder="Nhập địa chỉ email">
        					</div>
        					
        					{!! Form::submit('Tiếp tục thanh toán') !!}
        				{!! Form::close() !!}
        				@else
        					<h2>Bạn chưa có sản phẩm. Hãy click {!! HTML::link(route('public.getIndex'), 'tại đây') !!} để mua hàng</h2>
        				@endif
        			</div>
        		</section>

				<aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
					<div class="block block-progress">
						<div class="block-title ">Thông tin cửa hàng</div>
						<div class="block-content">
							<dl>
								<dt class="complete">
									
								</dt>
								<dd class="conplete">
									<address>
										Tên chủ shop : Nguyễn Trọng Hiếu.<br />
										Địa chỉ : 696 Tôn Đức Thắng - Đà Nẵng.<br />
										SKT : 000 111 222 333 Vietcombank.<br />
										SĐT : 0984 945 175.<br />
										Thời gian làm việc : 8h - 22h.<br />
									</address>
								</dd>
							</dl>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</section>
@stop