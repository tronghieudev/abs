 @foreach($cart as $value)
  	<li class="item first">
    	<div class="item-inner">
    		{!! HTML::decode(HTML::link('#', HTML::image('public/multimedia/images/products/'.$value['image'], $value['name_product']), ['class' => 'product-image'])) !!}
			<div class="product-details">
				<div class="access">
					<strong>{!! $value['value'] !!}</strong> x <span class="price">{!! number_format($value['price_buy'],0,'','.') !!} đ</span>
					<p class="product-name"><a href="#">{!! $value['name_product'] !!}</a> </p>
				</div>
			</div>
    	</div>
  	</li>
@endforeach