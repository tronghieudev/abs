<?php 

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Parameter;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CartController extends Controller {

	public function getIndex(Request $request) {
		$img = [];
		if(session()->has('cart')){
			foreach (session()->get('cart') as $key => $value) {
				$product = Product::select('images')->find($key);
				$images = json_decode($product->images, true);
				$img[$key] = $images[0];
			}
		}
		
		$price = 0;
		if($request->session()->has('cart')){
			$cart = $request->session()->get('cart');
			foreach ($cart as $value) {
				$price += $value['value'] * $value['price_buy'];
			}
		}
		return view()->make('public.modules.carts.index', ['img' => $img, 'price' => $price]);
	}

	public function addCart(Request $request) {
		if($request->ajax()){
			$input = Input::all();
			//dd($input);
			if(isset($input['colors'])) {
				$colors = json_encode($input['colors']);
			}else{
				$colors ='';
			}

			if(isset($input['sizes'])) {
				$sizes = json_encode($input['sizes']);
			}else{
				$sizes = '';
			}

			$product = Product::find($input['id']);
			$images = json_decode($product->images, true);
			$image = $images[0];
			$cart = $request->session()->get('cart');
			if(isset($cart) && array_key_exists($product->id, $cart)) {
				$cart[$input['id']]['value'] += $input['qty'];
			}else{
				$cart[$input['id']]= [
					'name_product' 	=> $product->name_product,
					'price_buy' 	=> $product->price_buy,
					'value' 		=> $input['qty'],
					'image' 		=> $image,
					'colors'		=> $colors,
					'sizes'			=> $sizes
				];
			}
			$request->session()->put('cart', $cart);
			return view()->make('public.modules.products.ajax.cart', ['cart' => $cart]);
		}
	}

	public function update(Request $request) {
		if($request->ajax()) {
			$input = Input::get();
			
			$cart = $request->session()->get('cart');
			$cart[$input['id']]['value'] =  $input['qty'];
			$request->session()->put('cart', $cart);
			$response['tt'] = number_format($input['qty'] * $cart[$input['id']]['price_buy'], 0, '' , '.');
			$response['price'] = 0;
			foreach ($cart as $value) {
				$response['price'] += $value['value'] * $value['price_buy'];
			}
			$response['price'] = number_format($response['price'], 0, '' , '.');
			return response()->json($response);
		}
	}

	public function clearCart(Request $request) {
		if($request->ajax()) {
			$request->session()->forget('cart');
		}
	}

	public function delItem(Request $request) {
		if($request->ajax()) {
			$cart = $request->session()->get('cart');
			unset($cart[Input::get('id')]);
			$request->session()->put('cart', $cart);
			$response['price'] = 0;
			foreach ($cart as $value) {
				$response['price'] += $value['value'] * $value['price_buy'];
			}
			return response()->json($response);
		}
	}

}