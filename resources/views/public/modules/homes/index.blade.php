@extends('public.main')

@section('extra-style')	
	<style type="text/css">
		#search_mini_form{
			margin-bottom: 0 !important;
		}
		.loading{
		    display: block;
		    margin: auto;
		    width: 100px;
		}
	</style>
@stop

@section('extra-lib')
	<script type="text/javascript">
		function addToCart(id) {
			var id = id;
			var qty = $('#qty').val();
			var token = '{!! csrf_token() !!}';
			if(typeof(qty) === 'undefined') {
				qty = 1;
			}
			// get size and color
			var checkbox = [];
		    checkbox['color'] = $("input[name='color[]']:checked").map(function(){
		      return $(this).val();
		    }).get(); 
		    checkbox['size'] = $("input[name='size[]']:checked").map(function(){
		      return $(this).val();
		    }).get();

			$.ajax({
				url: '{!! route('public.carts.addCart') !!}',
				type: 'POST',
				data: {id: id, qty: qty,_token : token, checkbox: checkbox},
			})
			.done(function(output) {
				$('#cart-sidebar').html(output);
				$('.cart_count').text($('#cart-sidebar li').length);
			})
		}
	</script>
	
	<script type="text/javascript">
		function tab(id, tab) {
			//console.log(id +' '+ tab);
			var token = '{!! csrf_token() !!}';
			$('.list-'+tab).html('{!! HTML::image('public/backend/images/loading.gif', '', ['class' => 'loading']) !!}');
			$.ajax({
				url: '{!! route('public.home.ajaxGetTab') !!}',
				type: 'POST',
				data: {id: id, _token : token},
			})
			.done(function(output) {
				$('.list-'+tab).html(output);
				//console.log(output);
			})
		}
	</script>
@stop

@section('content')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					{!! Breadcrumbs::render('home') !!}
				</div>
			</div>
		</div>
	</div>
<div class="our-features-box hidden-xs">
	<div class="container">
		<div class="features-block">
			<div class="col-md-3 col-xs-12 col-sm-6">
				<div class="feature-box first">
					<span class="fa fa-truck">&nbsp;</span>
					<div class="content">
						<h3>FREE SHIPPING WORLDWIDE</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-6">
				<div class="feature-box">
					<span class="fa fa-headphones">&nbsp;</span>
					<div class="content">
						<h3>24X7 CUSTOMER SUPPORT</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-6">
				<div class="feature-box">
					<span class="fa fa-dollar">&nbsp;</span>
					<div class="content">
						<h3>MONEY BACK GUARANTEE</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-6">
				<div class="feature-box last">
					<span class="fa fa-mobile">&nbsp;</span>
					<div class="content">
						<h3>Hotline  +(888) 123-4567</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Slider -->
<div id="magik-slideshow" class="magik-slideshow">
	@section('slide')
	@include('public.includes.slide')
	@show
</div>
<!-- end Slider --> 
<!-- mob features box -->
<div class="our-features-box hidden-lg hidden-sm hidden-md">
	<div class="container">
		<div class="features-block">
			<div class="col-lg-3 col-xs-12 col-sm-6">
				<div class="feature-box first">
					<span class="fa fa-truck"></span>
					<div class="content">
						<h3>FREE SHIPPING WORLDWIDE</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12 col-sm-6">
				<div class="feature-box">
					<span class="fa fa-headphones"></span>
					<div class="content">
						<h3>24X7 CUSTOMER SUPPORT</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12 col-sm-6">
				<div class="feature-box">
					<span class="fa fa-dollar"></span>
					<div class="content">
						<h3>MONEY BACK GUARANTEE</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12 col-sm-6">
				<div class="feature-box last">
					<span class="fa fa-mobile"></span>
					<div class="content">
						<h3>Hotline  +(888) 123-4567</h3>
						Lorem ipsum dolor sit amet. 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- promotion banner -->
<div class="promotion-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-4"><a href="#"><img alt="" src="public/frontend/images/banner1.png"></a></div>
			<div class="col-lg-5 col-sm-5 last"><a href="#"><img alt="" src="public/frontend/images/banner2.png"></a></div>
			<div class="col-lg-3 col-sm-3 last"><a href="#"><img alt="" src="public/frontend/images/banner3.png"></a></div>
		</div>
	</div>
</div>
<!-- New Products  + Tab -->
<div class="content-page">
	<div class="container">
		<!-- featured category -->
		@foreach($categories as $key => $value)
			<div class="category-product">
				<div class="navbar nav-menu">
					<div class="navbar-collapse">
						<ul class="nav navbar-nav">
							<li>
								<div class="new_title">
									<h2>{!! HTML::link(route('public.categories.getIndex', ['id' => $value->id]), $value->name_category, ['style' => 'color:#FFF']) !!}</h2>
								</div>
							</li>
							
							@if(!empty($value->children))
								@foreach($value->children as $k => $val)
									@if($k == 0)
										<?php $id = $val->id; ?>
										<li class="active" data-toggle="tab">
											{!! HTML::link('#', $val->name_category, ['onclick' => 'tab('.$val->id.','.$value->id.')']) !!}
										</li>
									@else
										<li data-toggle="tab">
											{!! HTML::link('#', $val->name_category, ['onclick' => 'tab('.$val->id.','.$value->id.')']) !!}
										</li>
									@endif
								@endforeach					
							@endif

						</ul>
					</div>
					<!-- /.navbar-collapse --> 
				</div>
				<div class="product-bestseller">
					<div class="product-bestseller-content">
						<div class="product-bestseller-list">
							<div class="tab-container">
								<!-- tab product -->
								<div class="tab-panel active">
									<div class="category-products">
										<ul class="products-grid list-{!! $value->id !!}">
											@if(!empty($products[$id]))
											@foreach($products[$id] as $product)
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
										</ul>
									</div>
									<!-- tab product -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
  
 
@stop