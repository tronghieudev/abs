<div class="category-products">
	<ul class="products-grid">
		@if(count($products))
			@foreach($products as $key => $product)
			<?php
				$imgs = json_decode($product->images,true);
				$img = $imgs[0];
			?>
			<li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<div class="item-inner">
					<div class="item-img">
						<div class="item-img-info">
							{!! HTML::decode(HTML::link(route('public.products.getIndex', ['id' => $product->id, 'title' => Unicode::make($product->name_product).'.html']), HTML::image('public/multimedia/images/products/'.$img, $product->name_product, ['height' => '360px']), ['class' => 'product-image', 'title' => $product->name_product])) !!}
							@if($key <= 6)
							<div class="new-label new-top-left">Mới</div>
							@endif
							
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
								{!! HTML::link(route('public.products.getIndex', ['id' => $product->id, 'title' => Unicode::make($product->name_product).'.html']), $product->name_product) !!}
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
									<div class="price-box">
										<p class="old-price"><span class="price-label">Regular Price:</span> <span class="price">$100.00 </span> </p>
										<p class="special-price"><span class="price-label">Special Price</span> <span class="price">{!! number_format($product->price_buy,0,'','.') !!} đ</span> </p>
									</div>
								</div>
								<div class="action">
									<button onclick="addToCart({!! $product->id !!})" class="button btn-cart" title="Thêm vào giỏ hàng" type="button">Thêm vào giỏ hàng</button>
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
	</ul>
</div>
<div class="toolbar">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			
		</div>
		<div class="col-lg-6 col-sm-7 col-md-5">
			<div class="pager page-main">
				<div class="pages">
					<label>Page:</label>
					{!! $products->render() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-sm-12 col-md-3">
			
		</div>
	</div>
</div>