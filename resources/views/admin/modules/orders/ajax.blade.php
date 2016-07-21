<p>
	ID đơn hàng : {!! $order->id !!}
</p>

@if(!empty($order->user_id))
	<p>
		Họ tên khách hàng : {!! $order->users->name !!}
	</p>
	<p>Địa chỉ : {!! $order->users->address_name !!}</p>
	<p>Số điện thoại : {!! $order->users->phone_number !!}</p>
	<p>Số điện thoại : {!! $order->users->email !!}</p>
	<p>Chi tiết đơn hàng : </p>
	@foreach($order->products as $detail)
		<div>
			<p><strong>Tên sản phẩm</strong> : {!! $detail->name_product !!}</p>
			<p>Mã sản phẩm : {!! $detail->id !!}</p>
			<p>Màu : 
				<?php $colors = json_decode($detail->pivot->colors) ?>
				@foreach($colors as $color)
					{!! $color !!}, 
				@endforeach
			</p>

			<p>Kich thước (size) : 
				<?php $colors = json_decode($detail->pivot->sizes) ?>
				@foreach($sizes as $size)
					{!! $size !!}, 
				@endforeach
			</p>
		</div>
	@endforeach

@else
	<p>
		Họ tên khách hàng : {!! $order->customers->name !!}
	</p>
	<p>Địa chỉ : {!! $order->customers->address_name !!}</p>
	<p>Số điện thoại : {!! $order->customers->phone_number !!}</p>
	<p>Số điện thoại : {!! $order->customers->email !!}</p>
	<p>Chi tiết đơn hàng : </p>
	@foreach($order->products as $detail)
		<div>
			<p><strong>Tên sản phẩm</strong> : {!! $detail->name_product !!}</p>
			<p>Mã sản phẩm : {!! $detail->id !!}</p>
			<p>Màu : 
				@if(!empty($detail->pivot->colors))
					<?php $colors = json_decode($detail->pivot->colors) ?>
					@foreach($colors as $color)
						{!! $color !!}, 
					@endforeach
				@endif
			</p>


			<p>Kich thước (size) : 
				@if(!empty($detail->pivot->sizes))
					<?php $sizes = json_decode($detail->pivot->sizes) ?>
					@foreach($sizes as $size)
						{!! $size !!}, 
					@endforeach
				@endif
			</p>
		</div>
	@endforeach
@endif