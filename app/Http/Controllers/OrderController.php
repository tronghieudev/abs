<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Order;

class OrderController extends Controller {
	public function getIndex(Request $request) {
		$user = Auth::user();
		if(!empty($user) && $user->level() == 4) {
			return redirect()->route('public.orders.end');
		}
		return view()->make('public.modules.orders.index');
	}

	public function postForm(Request $request) {
		$data = $request->all();
		$request->session()->put('customer_new', $data);
		return redirect()->route('public.orders.end');
	} 

	public function end(Request $request) {
		$data = $request->session()->get('customer_new');
		$cart = $request->session()->get('cart');
		if(isset($cart)) {
			$orders = $request->session()->get('cart');
		}else{
			$orders = [];
		}
		return view()->make('public.modules.orders.end', ['customer' => $data, 'orders' =>$orders]);

	} 

	public function postEnd(Request $request) {
		$carts = $request->session()->get('cart');
		$customer_new = $request->session()->get('customer_new');

		$data = $request->all();

		// save customer
		try{
			if(isset($customer_new)) {
				$customer = new Customer;
				$customer->fill($customer_new);
				$customer->save();
				$data['customer_id'] = $customer->id;
			}else{
				$data['user_id'] = Auth::user()->id;
			}
			// save order
			//dd($data);
			$order = new Order;
			$order->fill($data);
			$order->save();

			foreach ($carts as $key => $value) {
				$order->products()->attach($key, ['value' => $value['value'], 'colors' => $value['colors'], 'sizes' => $value['sizes']]);
			}
			return redirect()->route('public.orders.success');
			
		} catch (Exception $e) {
			return redirect()->back()->with('messages', 'Có lỗi trong quá trình đăt hàng');
		}

	}

	public function success(Request $request) {
		$carts = $request->session()->get('cart');
		$customer_new = $request->session()->get('customer_new');
		if(isset($carts)) {
			$request->session()->forget('cart');
		}
		if(isset($customer_new)) {
			$request->session()->forget('customer_new');
		}
		return view()->make('public.modules.orders.success');
	}

}