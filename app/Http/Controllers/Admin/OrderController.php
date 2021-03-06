<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Helpers\MenuSelect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;
use App\Order;
use App\Customer;

class OrderController extends Controller {

	public function getIndex() {
		$orders = Order::orderBy('status', 'DESC')->get();
		//dd($orders);
		return view()->make('admin.modules.orders.index', ['orders' => $orders]);
	}

	public function postCheck(Request $request) {
		if($request->ajax()) {
			$id = $request->id;
			$status = $request->status;
			$order = Order::find($id);
			$order->status = $status;
			$order->save();
			$response  = ['code' => 200];
			return response()->json($response);
		}
	}

	public function getDetail(Request $request){
		if($request->ajax()) {
			$id = $request->id;
			$order = Order::with('products')->find($id);
			return view()->make('admin.modules.orders.ajax', ['order' => $order]);
		}
	}

}