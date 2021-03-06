<?php
use App\Category;
// Home

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('public.getIndex'));
});

// Giỏ hàng

Breadcrumbs::register('cart', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Cart', route('public.carts.getIndex'));
});

// Danh mục

Breadcrumbs::register('category', function($breadcrumbs, $categories) {
	$breadcrumbs->parent('home');
	$cat = Category::find($categories->id);
	if($cat->parent_id == 0) {
		$breadcrumbs->push($categories->name_category, route('public.categories.getIndex', ['id' => $categories->id]));
	}else{
		$cat2 = Category::find($cat->parent_id);
		if($cat2->parent_id == 0) {
			$breadcrumbs->push($cat2->name_category, route('public.categories.getIndex', ['id' => $cat2->id]));
			$breadcrumbs->push($categories->name_category, route('public.categories.getIndex', ['id' => $categories->id]));
		}else{
			$cat3 = Category::find($cat2->parent_id);
			$breadcrumbs->push($cat3->name_category, route('public.categories.getIndex', ['id' => $cat3->id]));
			$breadcrumbs->push($cat2->name_category, route('public.categories.getIndex', ['id' => $cat2->id]));
			$breadcrumbs->push($categories->name_category, route('public.categories.getIndex', ['id' => $categories->id]));
		}
	}
});

// thanh toán

Breadcrumbs::register('order', function($breadcrumbs)
{
	$breadcrumbs->parent('home');
    $breadcrumbs->push('Check-out', route('public.orders.getIndex'));
});

