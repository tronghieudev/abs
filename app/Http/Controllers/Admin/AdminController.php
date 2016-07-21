<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Order;
use App\Customer;

class AdminController extends Controller {
	
	public function getIndex() {
		$users = User::with(['roles' => function($query) {
			$query->where('level', 4);
		}])->count();
		$orders = [];
		$orders = Order::select(DB::raw('count(*) as count, status'))->where('status', 1)->orWhere('status', 4)->groupBy('status')->get();

		return view('admin.modules.homes.index', ['users' => $users, 'orders' => $orders]);
	}

}