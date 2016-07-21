@extends('public.main')

@section('extra-style')
	<style type="text/css">
		.col-main {
			width: 100%;
		}
		ol label{
			cursor: pointer !important;
			margin: 0;
		}
		ol li input{
		    vertical-align: middle;
		    margin-right: 5px !important;
		    display: inline-block;
		}
		.block-layered-nav dd ol li:before{
			content: none;
		}
		.block .block-content .price{
			font-family: tahoma;
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
		$(document).ready(function() {
		
			$('.search-ajax').on('change', function(){
				/*
					*	get value price 
					*  	return array
				*/
				var price = [];
				$.each($('input[name="price[]"]:checked'),function() {
					price.push($(this).val());
				});
				/*
					*	get value color 
					*  	return array
				*/
				var color = [];
				$.each($('input[name="color[]"]:checked'),function() {
					color.push($(this).val());
				});
				/*
					*	get value size 
					*  	return array
				*/
				var size = [];
				$.each($('input[name="size[]"]:checked'),function() {
					size.push($(this).val());
				});

				
				var url = window.location.href;
				var new_url = url.split('?page=')[0];
				//new_url += "?price="+price+"&color="+color+"&size="+size;
				history.pushState({}, "", new_url);
				var position = $('.ajax').position();
				$('.ajax').html('{!! HTML::image('public/backend/images/loading.gif', '', ['class' => 'loading']) !!}');
				$('body').animate({scrollTop : 0}, 400);
				$.ajax({
					url: '{!! route('public.categories.getIndex', ['id' => $cat->id]) !!}',
					type: 'GET',
					data : {price: price, color : color, size : size}
				})
				.done(function(output) {
					$('.ajax').html(output);
					
				});
				
			});
			$(document).on('click', '.page-main a', function(e) {
				e.preventDefault();
				var price = [];
				$.each($('input[name="price[]"]:checked'),function() {
					price.push($(this).val());
				});
				
				var color = [];
				$.each($('input[name="color[]"]:checked'),function() {
					color.push($(this).val());
				});
				
				var size = [];
				$.each($('input[name="size[]"]:checked'),function() {
					size.push($(this).val());
				});

				var url = $(this).attr('href');
				var page = url.split('page=')[1];
				var position = $('.ajax').position();
				$('.ajax').html('{!! HTML::image('public/backend/images/loading.gif', '', ['class' => 'loading']) !!}');
				$('body').animate({scrollTop : 0}, 400);
				$.ajax({
					url: '?page='+page,
					type: 'GET',
					data: {price: price, color : color, size : size}
				})
				.done(function(output) {
					
					$('.ajax').html(output);
					//history.pushState({}, "", url);
				});
			});

			

		});

	</script>
@stop

@section('content')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					{!! Breadcrumbs::render('category', $cat) !!}
				</div>
			</div>
		</div>
	</div>

	<section class="main-container col2-left-layout bounceInUp animated">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<div class="category-description std">
						
					</div>
					<article class="col-main ajax">
						<h2 class="page-heading"> <span class="page-heading-title">{!! $cat->name_category !!}</span> </h2>
						
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
																<p class="old-price"><span class="price-label">Regular Price:</span> <span class="price">100.00 đ</span> </p>
																<p class="special-price"><span class="price-label">Special Price</span> <span class="price">{!! number_format($product->price_buy,0,'','.') !!} đ </span></p>
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
									<div class="pager">
										<div class="pages page-main">
											<label>Page:</label>
											{!! $products->render() !!}
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-sm-12 col-md-3">
									
								</div>
							</div>
						</div>
					</article>
					<!--	///*///======    End article  ========= //*/// --> 
				</div>
				<div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
					<aside class="col-left sidebar">
						<div class="side-nav-categories">
							<div class="block-title"> Danh mục sản phẩm </div>
							<!--block-title--> 
							<!-- BEGIN BOX-CATEGORY -->
							<div class="box-content box-category">
								<ul>
									@foreach($categories as $val)
										
									<li>
										<a href="{!! route('public.categories.getIndex', ['id' => $val->id]) !!}">
											{!! $val->name_category !!}
										</a> 
										@if(count($val->children))
										<span class="subDropdown minus"></span>
										<ul class="level0_415" style="display:block">
											@foreach($val->children as $cat2)
											<li>
												{!! HTML::link(route('public.categories.getIndex', ['id' => $cat2->id]), $cat2->name_category) !!} 
												@if(count($cat2->children))
												<span class="subDropdown plus"></span>
												<ul class="level1" style="display:none">
													@foreach($cat2->children as $cat3)
													<li> 
													{!! HTML::link(route('public.categories.getIndex', ['id' => $cat3->id]), $cat3->name_category) !!} 
													</li>
													@endforeach
													<!--end for-each -->
												</ul>
												@endif
												<!--level1--> 
											</li>
											@endforeach
											
											
										</ul>
										@endif
										<!--level0--> 
									</li>
									<!--level 0-->
									@endforeach
								</ul>
							</div>
							<!--box-content box-category--> 
						</div>
						<div class="block block-layered-nav">
							<div class="block-title">Tìm kiếm</div>
							<div class="block-content">
								<dl id="narrow-by-list ">
									<dt class="odd">Giá</dt>
									<dd class="odd">
										<ol>
											@foreach($searchs->price_searchs as $key => $value)
												<?php
													$k = $key;
												?>
												@if($key == 0)
													<li> 
														<label><input class="search-ajax" type="checkbox" name="price[]" value="{!! $value->price_from !!}|"><span class="price">Giá dưới {!! number_format($value->price_from,0,'','.') !!} đ</span></span></label>
													</li>
												@endif
												<li> 
													<label><input class="search-ajax" type="checkbox" name="price[]" value="{!! $value->price_from !!}|{!! $value->price_to !!}"><span class="price">{!! number_format($value->price_from,0,'','.') !!}</span> - <span class="price">{!! number_format($value->price_to,0,'','.') !!} đ</span></label>
												</li>
											@endforeach
											<li> 
												<label><input class="search-ajax" type="checkbox" name="price[]" value="|{!! $value->price_to !!}"><span class="price"> <span class="price">Giá trên {!! number_format($value->price_to,0,'','.') !!} đ</span></label>
											</li>
											
										</ol>
									</dd>
									<dt class="even">Màu</dt>
									<dd class="even">
										<ol>
											@foreach($searchs->colors as $value)
											<li> <label><input class="search-ajax" type="checkbox" name="color[]" value="{!! $value->id !!}" >{!! $value->color !!}</label></li>
											@endforeach
										</ol>
									</dd>
									<dt class="odd">Kích thước (size)</dt>
									<dd class="odd">
										<ol>
											@foreach($searchs->sizes as $value)
											<li> <label><input class="search-ajax" type="checkbox" name="size[]" value="{!! $value->id !!}" >{!! $value->size !!}</label></li>
											@endforeach
										</ol>
									</dd>
								</dl>
							</div>
						</div>

						<div class="block block-compare">
							<div class="block-title ">Compare Products (2)</div>
							<div class="block-content">
								<ol id="compare-items">
									<li class="item odd">
										<input type="hidden" value="2173" class="compare-item-id">
										<a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Polyester Wrapped Cushions</a> 
									</li>
									<li class="item last even">
										<input type="hidden" value="2174" class="compare-item-id">
										<a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a> 
									</li>
								</ol>
								<div class="ajax-checkout">
									<button type="submit" title="Submit" class="button button-compare"><span>Compare</span></button>
									<button type="submit" title="Submit" class="button button-clear"><span>Clear</span></button>
								</div>
							</div>
						</div>
						<div class="custom-slider">
							<div>
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
										<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
										<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
									</ol>
									<div class="carousel-inner">
										<div class="item active">
											<img src="images/slide3.jpg" alt="slide3">
											<div class="carousel-caption">
												<h3><a title=" Sample Product" href="#">50% OFF</a></h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
												<a class="link" href="#">Buy Now</a>
											</div>
										</div>
										<div class="item">
											<img src="images/slide1.jpg" alt="slide1">
											<div class="carousel-caption">
												<h3><a title=" Sample Product" href="#">Hot collection</a></h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
											</div>
										</div>
										<div class="item">
											<img src="images/slide2.jpg" alt="slide2">
											<div class="carousel-caption">
												<h3><a title=" Sample Product" href="#">Summer collection</a></h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
											</div>
										</div>
									</div>
									<a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span> </a>
								</div>
							</div>
						</div>
						<div class="block block-list block-viewed">
							<div class="block-title"> Xem gần đây </div>
							<div class="block-content">
								<ol id="recently-viewed-items">
								@if(session()->has('viewPro'))
									@foreach(session()->get('viewPro') as $key => $value)
									<li class="item odd">
										<p class="product-name">
											{!! HTML::link(route('public.products.getIndex', ['id' => $key, 'title' => Unicode::make($value['name']).'.html']), $value['name']) !!}
										</p>
									</li>
									@endforeach
								@endif	
								</ol>
							</div>
						</div>
						<div class="block block-tags">
							<div class="block-title"> Từ khoá</div>
							<div class="block-content">
								<ul class="tags-list">
									<li><a href="#" style="font-size:98.3333333333%;">Camera</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">Hohoho</a></li>
									<li><a href="#" style="font-size:145%;">SEXY</a></li>
									<li><a href="#" style="font-size:75%;">Tag</a></li>
									<li><a href="#" style="font-size:110%;">Test</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">bones</a></li>
									<li><a href="#" style="font-size:110%;">cool</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">cool t-shirt</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">crap</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">good</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">green</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">hip</a></li>
									<li><a href="#" style="font-size:75%;">laptop</a></li>
									<li><a href="#" style="font-size:75%;">mobile</a></li>
									<li><a href="#" style="font-size:75%;">nice</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">phone</a></li>
									<li><a href="#" style="font-size:98.3333333333%;">red</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">tight</a></li>
									<li><a href="#" style="font-size:75%;">trendy</a></li>
									<li><a href="#" style="font-size:86.6666666667%;">young</a></li>
								</ul>
								<div class="actions"> <a href="#" class="view-all">View All Tags</a> </div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</div>
		<div class="ajax" style="display: none;" data-page="1"></div>
	</section>
@stop
