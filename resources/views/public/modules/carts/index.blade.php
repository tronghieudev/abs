@extends('public.main')

@section('extra-lib')
	<script type="text/javascript">
		function update(id, qty) {
			//alert(id + ' '+ qty);
			var token = '{!! csrf_token() !!}';
			$.ajax({
				url: '{!! route('public.carts.update') !!}',
				type: 'POST',
				data: {id: id, qty: qty, _token: token},
			})
			.done(function(output) {
				console.log(output);
				$('.tt_'+id+' span span').html(output.tt + ' đ');
				$('.tongtien').html(output.price + ' đ');
			})			
		}

		function clearCart() {
			var token = '{!! csrf_token() !!}';
			$.ajax({
				url: '{!! route('public.carts.clearCart') !!}',
				type: 'POST',
				data: {_token: token},
			})
			.done(function(output) {
				location.reload();
			})
		}

		function delitem(id) {
			var token = '{!! csrf_token() !!}';
			$.ajax({
				url: '{!! route('public.carts.delItem') !!}',
				type: 'POST',
				data: {_token: token, id: id},
			})
			.done(function(output) {
				$('.tr_'+id).hide('slow');
				$('.tongtien').html('$ '+ output.price);
			})
		}

	</script>
	<style type="text/css">
	a.button{
	    border: 1px solid;
	    text-decoration: none;
	    background: #FFD740;
	    color: #333;
	}
	</style>
@stop

@section('content')
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					{!! Breadcrumbs::render('cart') !!}
				</div>
			</div>
		</div>
	</div>

	<section class="main-container col1-layout">
		<div class="main container">
			<div class="col-main">
				<div class="cart wow bounceInUp animated">
					<div class="page-title">
						<h2>Giỏ hàng</h2>
					</div>
					@if(session()->has('cart') && count(session()->get('cart')) > 0)
						<div class="table-responsive">
							<form method="post" action="">
								<input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
								
								<fieldset>
									<table class="data-table cart-table" id="shopping-cart-table">
										<colgroup>
											<col width="1">
											<col>
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
											<col width="1">
										</colgroup>
										<thead>
											<tr class="first last">
												<th rowspan="1">&nbsp;</th>
												<th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
												<th rowspan="1"></th>
												<th colspan="1" class="a-center"><span class="nobr">Giá</span></th>
												<th class="a-center" rowspan="1">Số lượng</th>
												<th colspan="1" class="a-center">Thành tiền</th>
												<th class="a-center" rowspan="1">&nbsp;</th>
											</tr>
										</thead>
										<tfoot>
											<tr class="first last">
												<td class="a-right last" colspan="50">
													{!! HTML::decode(HTML::link(route('public.getIndex'), '<span>Tiếp tục mua sắm</span>', ['class' => 'button btn-continue'])) !!}
													<button id="empty_cart_button" class="button btn-empty" title="Clear Cart" value="empty_cart" name="update_cart_action" type="button" onclick="clearCart()"><span>Clear Cart</span></button>
												</td>
											</tr>
										</tfoot>
										<tbody>
											
											@foreach(session()->get('cart') as $key => $value)
												<tr class="first odd tr_{!! $key !!}">
													<td class="image">
														<a class="product-image" title="{!! $value['name_product'] !!}" href="#">
														{!! HTML::image('public/multimedia/images/products/'.$img[$key], $value['name_product'], ['width' => '75px']) !!}
														</a>
													</td>
													<td>
														<h2 class="product-name"> <a href="#">{!! $value['name_product'] !!}</a> </h2>
													</td>
													<td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15945/"></a></td>
													<td class="a-right"><span class="cart-price"> <span class="price">{!! number_format($value['price_buy'],0,'','.') !!} đ</span> </span></td>
													<td class="a-center movewishlist"><input min="1" type="number" class="input-text qty" title="Qty" size="4" value="{!! $value['value'] !!}" name="cart[{!! $key !!}]" onchange ="update({!! $key  !!}, $(this).val())"></td>
													<td class="a-right movewishlist tt_{!! $key !!}"><span class="cart-price"> <span class="price">
													{!! number_format($value['value'] * $value['price_buy'],0,'','.') !!} đ
													</td>
													<td class="a-center last"><a class="button remove-item" title="Remove item" href="#" onclick="delitem({!! $key !!})"><span><span>Remove item</span></span></a></td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
								</fieldset>
							</form>
						</div>
						<!-- BEGIN CART COLLATERALS -->
						<div class="cart-collaterals row">
							<div class="col-sm-4">
								<div class="shipping">
									<h3>Estimate Shipping and Tax</h3>
									<div class="shipping-form">
										<form id="shipping-zip-form" method="post" action="#estimatePost/">
											<p>Enter your destination to get a shipping estimate.</p>
											<ul class="form-list">
												<li>
													<label class="required" for="country"><em>*</em>Country</label>
													<div class="input-box">
														<select title="Country" class="validate-select" id="country" name="country_id">
															<option value=""> </option>
															<option value="AF">Afghanistan</option>
															
														</select>
													</div>
												</li>
												<li>
													<label for="region_id">State/Province</label>
													<div class="input-box">
														<select style="" title="State/Province" name="region_id" id="region_id" defaultvalue="" class="required-entry validate-select">
															<option value="">Please select region, state or province</option>
															<option value="1" title="Alabama">Alabama</option>
															
														</select>
														<input type="text" style="display:none;" class="input-text required-entry" title="State/Province" value="" name="region" id="region">
													</div>
												</li>
												<li>
													<label for="postcode">Zip/Postal Code</label>
													<div class="input-box">
														<input type="text" value="" name="estimate_postcode" id="postcode" class="input-text validate-postcode">
													</div>
												</li>
											</ul>
											<div class="buttons-set11">
												<button class="button get-quote" onclick="coShippingMethodForm.submit()" title="Get a Quote" type="button"><span>Get a Quote</span></button>
											</div>
											<!--buttons-set11-->
										</form>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="discount">
									<h3>Discount Codes</h3>
									<form method="post" action="#couponPost/" id="discount-coupon-form">
										<label for="coupon_code">Enter your coupon code if you have one.</label>
										<input type="hidden" value="0" id="remove-coupone" name="remove">
										<input type="text" value="" name="coupon_code" id="coupon_code" class="input-text fullwidth">
										<button value="Apply Coupon" onclick="discountForm.submit(false)" class="button coupon " title="Apply Coupon" type="button"><span>Apply Coupon</span></button>
									</form>
								</div>
							</div>
							<div class="totals col-sm-4">
								<h3>Shopping Cart Total</h3>
								<div class="inner">
									<table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
										<colgroup>
											<col>
											<col width="1">
										</colgroup>
										<tfoot>
											<tr>
												<td colspan="1" class="a-left" style=""><strong>Tổng tiền</strong></td>
												<td class="a-right" style="">
													<strong>
														<span class="price tongtien">

															{!! number_format($price, 0, '' ,'.') !!} đ
														</span>
													</strong>
												</td>
											</tr>
										</tfoot>
										<tbody>
											<tr>
												<td colspan="1" class="a-left" style=""> Thuế (VAT) </td>
												<td class="a-right" style=""><span class="price">{!! $price * 0 / 100 !!} đ</span></td>
											</tr>
										</tbody>
									</table>
									<ul class="checkout">
										<li>
											<a href="{!! route('public.orders.getIndex') !!}" class="button btn-proceed-checkout" title="Tiếp tục thanh toán"><span>Tiếp tục thanh toán</span></a>
										</li>
										<br>
										<li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout with Multiple Addresses</a> </li>
										<br>
									</ul>
								</div>
								<!--inner--> 
							</div>
						</div>
						<!--cart-collaterals--> 
					</div>
				@else
					<h2>Giỏ hàng rỗng</h2>
				@endif
				<div class="crosssel bounceInUp animated">
					<div class="new_title">
						<h2>you may be interested</h2>
					</div>
					<div class="category-products">
						<ul class="products-grid">
							<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info">
											<a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product10.jpg"> </a>
											<div class="box-hover">
												<ul class="add-to-links">
													<li><a class="link-quickview" href="quick_view.html">Quick View</a>
													</li>
													<li><a class="link-wishlist" href="wishlist.html">Wishlist</a>
													</li>
													<li><a class="link-compare" href="compare.html">Compare</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
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
													<div class="price-box"> <span class="regular-price"> <span class="price">$155.00</span> </span>
													</div>
												</div>
												<div class="action">
													<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info">
											<a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product1.jpg"> </a>
											<div class="box-hover">
												<ul class="add-to-links">
													<li><a class="link-quickview" href="quick_view.html">Quick View</a>
													</li>
													<li><a class="link-wishlist" href="wishlist.html">Wishlist</a>
													</li>
													<li><a class="link-compare" href="compare.html">Compare</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
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
													<div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span> </span>
													</div>
												</div>
												<div class="action">
													<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info">
											<a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product2.jpg"> </a>
											<div class="box-hover">
												<ul class="add-to-links">
													<li><a class="link-quickview" href="quick_view.html">Quick View</a>
													</li>
													<li><a class="link-wishlist" href="wishlist.html">Wishlist</a>
													</li>
													<li><a class="link-compare" href="compare.html">Compare</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
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
													<div class="price-box"> <span class="regular-price"> <span class="price">$99.00</span> </span>
													</div>
												</div>
												<div class="action">
													<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info">
											<a class="product-image" title="Retis lapen casen" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product3.jpg"> </a>
											<div class="new-label new-top-left">new</div>
											<div class="box-hover">
												<ul class="add-to-links">
													<li><a class="link-quickview" href="quick_view.html">Quick View</a>
													</li>
													<li><a class="link-wishlist" href="wishlist.html">Wishlist</a>
													</li>
													<li><a class="link-compare" href="compare.html">Compare</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
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
														<p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $156.00 </span> </p>
														<p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $167.00 </span> </p>
													</div>
												</div>
												<div class="action">
													<button class="button btn-cart" type="button" title="" data-original-title="Add to Cart"><span>Add to Cart</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop