<?php namespace App\Http\Controllers;

use App\Category;
use DB;
use App\Product;
use App\Parameter;
use App\Helpers\MenuSelect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function getIndex() {
		$categories = Category::tree();
		// $category = $categories->first();
		$products = [];
		$id = [];
		foreach ($categories as $value) {
			if(!empty($value->children)){
				$id[$value->children[0]->id] = [];
				if(!empty($value->children[0]->children)){
					foreach ($value->children[0]->children as $v) {
						$id[$value->children[0]->id][] = $v->id;
					}
				}
			}
		}
		$select = [];
		foreach ($id as $key => $value) {
			if(!empty($value)){
				$select[$key] = 'SELECT * FROM products WHERE status = 1 AND category_id = '.$key;
				foreach ($value as $val) {
					$select[$key] .= ' OR category_id = '. $val.' AND status =1';
				}
			}else{
				$select[$key] = 'SELECT * FROM products WHERE status = 1 AND category_id = '.$key;
			}
		}
		foreach ($select as $key => $value) {
			$products[$key] = DB::select($value. ' ORDER BY id DESC LIMIT 0,8');
		}

		return view()->make('public.modules.homes.index', ['categories' => $categories])->with('products', $products);
	}

	public function ajaxGetTab(Request $request) {
		if($request->ajax()) {
			$id = Input::get('id');
			$categories = Category::where('parent_id', $id)->get();
			$select = '';
			if($categories->count()){
				$select = 'SELECT * FROM products WHERE status = 1 AND category_id = '.$id;
				foreach ($categories as $value) {
					$select .= ' OR category_id = '. $value->id.' AND status =1';
				}
			}else{
				$select = 'SELECT * FROM products WHERE status = 1 AND category_id = '.$id;
			}
			//return $select;
			$products = DB::select($select. ' ORDER BY id DESC LIMIT 0,8');
			return view()->make('public.modules.homes.ajax.tab', ['products' => $products]);
		}
	}
	
}
