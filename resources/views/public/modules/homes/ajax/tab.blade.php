@if(!empty($products))
@foreach($products as $product)
	<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
		<div class="item-inner">
			<div class="item-img">
				<div class="item-img-info">
					<?php
						$img = json_decode($product->images, true);
						$image = $img[0];
					?>
					{!! HTML::decode(HTML::link(route('public.products.getIndex', ['id' => $product->id, Unicode::make($product->name_product).'.html']), HTML::image('public/multimedia/images/products/'.$image, $product->name_product))) !!}
					<div class="box-hover">
						<ul class="add-to-links">
							<li><a class="link-quickview" href="quick_view.html">Quick View</a> </li>
							<li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
							<li><a class="link-compare" href="compare.html">Compare</a> </li>
						</ul>
					</div>
				</div>
			</div>
			<div class="item-info">
				<div class="info-inner">
					<div class="item-title">
						{!! HTML::link(route('public.products.getIndex', ['id' => $product->id, Unicode::make($product->name_product).'.html']), $product->name_product) !!}
					</div>
					<div class="item-content">
						<div class="rating">
							<div class="ratings">
								<div class="rating-box">
									<div style="width:80%" class="rating"></div>
								</div>
								<p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
							</div>
						</div>
						<div class="item-price">
							<div class="price-box"> <span class="regular-price"> <span class="price">{!! number_format($product->price_buy,0,'','.') !!} đ</span> </span> </div>
						</div>
						<div class="action">
							<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart" onclick="addToCart({!! $product->id !!})"><span>Thêm vào giỏ hàng</span> </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
@endforeach
@else
	<p>Chưa có sản phẩm</p>
@endif