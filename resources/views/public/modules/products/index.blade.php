@extends('public.main')

@section('extra-lib')
	{!! HTML::script('public/frontend/js/cloud-zoom.js') !!}
	<script type="text/javascript">
		$(document).ready(function() {
			$("input:checkbox").on('change',function(event){
				var color = $("input[name='color[]']:checked").length;
				var size = $("input[name='size[]']:checked").length;
			    var num = $('#qty').val();
			    if( color > num  || size > num) {
			    	alert('Quý khách vui lòng không chọn màu hoặc size nhiều hơn số lượng sản phẩm')
			    }
			});
		});	
		function addToCart(id) {
			var id = id;
			var qty = $('#qty').val();
			var token = '{!! csrf_token() !!}';
			if(typeof(qty) === 'undefined') {
				qty = 1;
			}
			// get size and color
			var colors = [];
		    $("input[name='color[]']:checked").each(function() {
				colors.push(this.value);
			});
			var sizes = [];
		    $("input[name='size[]']:checked").each(function() {
			   	sizes.push(this.value);
			});
			//console.log(sizes);
			if(qty < {!! $data->value !!}){
				$.ajax({
					url: '{!! route('public.carts.addCart') !!}',
					type: 'POST',
					data: {id: id, qty: qty , sizes: sizes, colors: colors , _token : token},
				})
				.done(function(output) {
					//$('body').html(output);
					$('#cart-sidebar').html(output);
					$('.cart_count').text($('#cart-sidebar li').length);
				});
			}else{
				alert('Bạn đã mua quá số lượng');
			}
		}
	</script>
@stop

@section('content')
	<div class="breadcrumbs">
	    <div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul>
						<li class="home"> <a href="index-2.html" title="Go to Home Page">Home</a> <span>/</span> </li>
						<li class="category1599"> <a href="grid.html" title="">Women</a> <span>/ </span> </li>
						<li class="category1600"> <a href="grid.html" title="">Styliest Bag</a> <span>/</span> </li>
						<li class="category1601"> <strong>Clutch Handbags</strong> </li>
					</ul>
				</div>
			</div>
	    </div>
  	</div>

  	<section class="main-container col1-layout">
		<div class="main">
			<div class="container">
				<div class="row">
					<div class="col-main">
						<div class="product-view">
							<div class="product-essential">
								{!! Form::open(['url' => route('public.carts.addCart')]) !!}
									<input name="id" value="{!! $data->id !!}" type="hidden">
									<div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
										<div class="new-label new-top-left"> New </div>
										<div class="product-image">
											<?php
												$images = json_decode($data->images, true);
											?>
											<div class="product-full"> 
												{!! HTML::image('public/multimedia/images/products/'.$images[0], $data->name_product, ['id' => 'product-zoom', 'data-zoom-image' => '../../public/multimedia/images/products/'.$images[0]]) !!}
											</div>
											<div class="more-views">
												<div class="slider-items-products">
													<div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
														<div class="slider-items slider-width-col4 block-content">
															@foreach($images as $img)
																<div class="more-views-items"> 
																	<a href="#" data-image="../../public/multimedia/images/products/{!! $img !!}" data-zoom-image="../../public/multimedia/images/products/{!! $img !!}"> 
																		{!! HTML::image('public/multimedia/images/products/'.$img, $data->name_product, ['id' => 'product-zoom']) !!} 
																	</a>
																</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- end: more-images --> 
									</div>
									<div class="product-shop col-lg-8 col-sm-7 col-xs-12">
										<div class="product-name">
											<h1>{!! $data->name_product !!}</h1>
										</div>
										<div class="ratings">
											<div class="rating-box">
												<div style="width:60%" class="rating"></div>
											</div>
											<p class="rating-links"> <a href="#">1 Nhận xét</a></p>
										</div>
										<div class="price-block">
											<div class="price-box">
												<p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> ${!! $data->price_buy !!} </span> </p>
												<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> ${!! $data->price_buy + 20!!} </span> </p>
												<p class="availability in-stock pull-right">
													
														@if($data->value > 0)
															<span>
																Còn hàng
															</span>
														@else
															<span style="background: #DA0000;color: #E2E88E">
																Hết hàng
															</span>
														@endif
													
												</p>
											</div>
										</div>
										<div class="short-description">
											<h2>Mô tả sản phẩm</h2>
											<p>{!! $data->preview !!}</p>
										</div>
										@if($data->value > 0)
											<div class="add-to-box">
												<div class="add-to-cart">
													<div class="pull-left">
														<div class="custom pull-left">
															<button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
															<input type="number" class="input-text qty" title="Qty" value="1" max="{!! $data->value !!}" id="qty" name="qty">
															<button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
														</div>
													</div>
													<button onclick="addToCart({!! $data->id !!})" class="button btn-cart" title="Add to Cart" type="button">Thêm vào giỏ hàng</button>
												</div>
											</div>
										@endif
										<div class="social">
											<h2>Màu : </h2>
											<ul class="link">
												@foreach($data->colors as $value)
													<li class="fb">
														<div class="checkbox">
															<label class="checkbox-inline">
																{!! Form::checkbox('color[]', $value->color) !!} {!! $value->color !!}
															</label>
														</div>
													</li>
												@endforeach
											</ul>
										</div>
										<div class="clearfix"></div>
										<div class="social" >
											<h2>Kích thước (size) : </h2>
											<ul class="link">
												@foreach($data->sizes as $value)
													<li class="fb">
														<div class="checkbox">
															<label class="checkbox-inline">
																{!! Form::checkbox('size[]', $value->size) !!} {!! $value->size !!}
															</label>
														</div>
													</li>
												@endforeach
											</ul>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
						<div class="add_info">
							<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
								<li class="active"> <a href="#product_tabs_description" data-toggle="tab" aria-expanded="true"> Chi tiết </a> </li>
								<li class=""> <a href="#reviews_tabs" data-toggle="tab" aria-expanded="false">Nhận xét</a> </li>
							</ul>
							<div id="productTabContent" class="tab-content">
								<div class="tab-pane fade active in" id="product_tabs_description">
									<div class="std" >
										<div class="col-sm-3"></div>
										<div class="col-sm-6">
											<table class="table table-bordered" >
												<thead>
													<tr>
														<th colspan="2" style="text-align: center;">Chi tiết</th>
													</tr>
												</thead>
												<tbody>
													
													@foreach($data->parameters as $value)
														<tr>
															<th scope="row" style="width: 50%;" >{!! $value->name_parameter !!}</th>
															<td style="width: 50%;" >{!! $value->pivot->value !!}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="col-sm-3"></div>
									</div>
								</div>
								<div class="tab-pane fade" id="reviews_tabs">
									<div class="box-collateral box-reviews" id="customer-reviews">
										<div class="box-reviews1">
											<div class="form-add">
												<form id="review-form" method="post" action="http://www.magikcommerce.com/review/product/post/id/176/">
													<h3>Write Your Own Review</h3>
													<fieldset>
														<h4>How do you rate this product? <em class="required">*</em></h4>
														<span id="input-message-box"></span>
														<table id="product-review-table" class="data-table">
															<thead>
																<tr class="first last">
																	<th>&nbsp;</th>
																	<th><span class="nobr">1 *</span></th>
																	<th><span class="nobr">2 *</span></th>
																	<th><span class="nobr">3 *</span></th>
																	<th><span class="nobr">4 *</span></th>
																	<th><span class="nobr">5 *</span></th>
																</tr>
															</thead>
															<tbody>
																<tr class="first odd">
																	<th>Price</th>
																	<td class="value"><input type="radio" class="radio" value="11" id="Price_1" name="ratings[3]"></td>
																	<td class="value"><input type="radio" class="radio" value="12" id="Price_2" name="ratings[3]"></td>
																	<td class="value"><input type="radio" class="radio" value="13" id="Price_3" name="ratings[3]"></td>
																	<td class="value"><input type="radio" class="radio" value="14" id="Price_4" name="ratings[3]"></td>
																	<td class="value last"><input type="radio" class="radio" value="15" id="Price_5" name="ratings[3]"></td>
																</tr>
																<tr class="even">
																	<th>Value</th>
																	<td class="value"><input type="radio" class="radio" value="6" id="Value_1" name="ratings[2]"></td>
																	<td class="value"><input type="radio" class="radio" value="7" id="Value_2" name="ratings[2]"></td>
																	<td class="value"><input type="radio" class="radio" value="8" id="Value_3" name="ratings[2]"></td>
																	<td class="value"><input type="radio" class="radio" value="9" id="Value_4" name="ratings[2]"></td>
																	<td class="value last"><input type="radio" class="radio" value="10" id="Value_5" name="ratings[2]"></td>
																</tr>
																<tr class="last odd">
																	<th>Quality</th>
																	<td class="value"><input type="radio" class="radio" value="1" id="Quality_1" name="ratings[1]"></td>
																	<td class="value"><input type="radio" class="radio" value="2" id="Quality_2" name="ratings[1]"></td>
																	<td class="value"><input type="radio" class="radio" value="3" id="Quality_3" name="ratings[1]"></td>
																	<td class="value"><input type="radio" class="radio" value="4" id="Quality_4" name="ratings[1]"></td>
																	<td class="value last"><input type="radio" class="radio" value="5" id="Quality_5" name="ratings[1]"></td>
																</tr>
															</tbody>
														</table>
														<input type="hidden" value="" class="validate-rating" name="validate_rating">
														<div class="review1">
															<ul class="form-list">
																<li>
																	<label class="required" for="nickname_field">Nickname<em>*</em></label>
																	<div class="input-box">
																		<input type="text" class="input-text" id="nickname_field" name="nickname">
																	</div>
																</li>
																<li>
																	<label class="required" for="summary_field">Summary<em>*</em></label>
																	<div class="input-box">
																		<input type="text" class="input-text" id="summary_field" name="title">
																	</div>
																</li>
															</ul>
														</div>
														<div class="review2">
															<ul>
																<li>
																	<label class="required " for="review_field">Review<em>*</em></label>
																	<div class="input-box">
																		<textarea rows="3" cols="5" id="review_field" name="detail"></textarea>
																	</div>
																</li>
															</ul>
															<div class="buttons-set">
																<button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
										<div class="box-reviews2">
											<h3>Customer Reviews</h3>
											<div class="box visible">
												<ul>
													<li>
														<table class="ratings-table">
															<tbody>
																<tr>
																	<th>Value</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Quality</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Price</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
														<div class="review">
															<h6><a href="#">Excellent</a></h6>
															<small>Review by <span>Leslie Prichard </span>on 1/3/2014 </small>
															<div class="review-txt"> I have purchased shirts from Minimalism a few times and am never disappointed. The quality is excellent and the shipping is amazing. It seems like it's at your front door the minute you get off your pc. I have received my purchases within two days - amazing.</div>
														</div>
													</li>
													<li class="even">
														<table class="ratings-table">
															<tbody>
																<tr>
																	<th>Value</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Quality</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Price</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:80%;"></div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
														<div class="review">
															<h6><a href="#/catalog/product/view/id/60/">Amazing</a></h6>
															<small>Review by <span>Sandra Parker</span>on 1/3/2014 </small>
															<div class="review-txt"> Minimalism is the online ! </div>
														</div>
													</li>
													<li>
														<table class="ratings-table">
															<tbody>
																<tr>
																	<th>Value</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Quality</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:100%;"></div>
																		</div>
																	</td>
																</tr>
																<tr>
																	<th>Price</th>
																	<td>
																		<div class="rating-box">
																			<div class="rating" style="width:80%;"></div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
														<div class="review">
															<h6><a href="#/catalog/product/view/id/59/">Nicely</a></h6>
															<small>Review by <span>Anthony  Lewis</span>on 1/3/2014 </small>
															<div class="review-txt last"> Unbeatable service and selection. This store has the best business model I have seen on the net. They are true to their word, and go the extra mile for their customers. I felt like a purchasing partner more than a customer. You have a lifetime client in me. </div>
														</div>
													</li>
												</ul>
											</div>
											<div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
    <div class="container">
        <!-- Related Slider -->
        <div class="related-pro">
			<div class="slider-items-products">
				<div class="related-block">
					<div id="related-products-slider" class="product-flexslider hidden-buttons">
						<div class="home-block-inner">
							<div class="block-title">
								<h2>Sản phẩm liên quan</h2>
								<div class="hidden-xs hidden-sm"></div>
							</div>
						</div>
						<div class="slider-items slider-width-col4 products-grid block-content">
							@if(!empty($listProduct))
								@foreach($listProduct as $value)
									<?php
										$images = json_decode($value->images, true);
										$img = $images[0];
									?>
									<div class="item">
										<div class="item-inner">
											<div class="item-img">
												<div class="item-img-info">
													{!! HTML::decode(HTML::link(route('public.products.getIndex', ['id' => $value->id, 'title' => Unicode::make($value->name_product).'.html']), HTML::image('public/multimedia/images/products/'.$img), ['class' => 'product-image'])) !!}
													<div class="new-label new-top-right">new</div>
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
													<div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> {!! $value->name_product !!} </a> </div>
													<div class="rating">
														<div class="ratings">
															<div class="rating-box">
																<div style="width:80%" class="rating"></div>
															</div>
															<p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
														</div>
													</div>
													<div class="item-content">
														<div class="item-price">
															<div class="price-box"> <span class="regular-price"> <span class="price">{!! number_format($value->price_buy, 0, '', '.') !!} đ</span> </span> </div>
														</div>
														<div class="action">
															<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- Item -->
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End related products Slider --> 
	</div>
@stop