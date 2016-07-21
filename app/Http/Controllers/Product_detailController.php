<?php

namespace App\Http\Controllers;

use DB;
use App\Category;
use App\Product;
use App\Parameter;
use App\Search;
use App\Search_Price;
use App\Helpers\Unicode;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Product_detailController extends Controller {

	protected $child = [];

	public function getIndex(Request $request, $id, $title) {
		$data = Product::with('categories', 'colors', 'sizes', 'parameters')->find($id);
		
		if(count($data)) {
			$listProduct = Product::where('category_id', $data->category_id)->where('id', '!=', $data->id)->where('status', 1)->get();
			//dd($listProduct);
			if(session()->has('viewPro')){
				$viewPro = session()->get('viewPro');
				$viewPro[$data->category_id] = [
					'name' => $data->name_product,
				];
				$request->session()->put('viewPro', $viewPro);
			}else{
				$viewPro[$data->category_id] = [
					'name' => $data->name_product,
				];
				$request->session()->put('viewPro', $viewPro);
			}
			
			return View::make('public.modules.products.index', ['data' => $data, 'listProduct' => $listProduct]);
		} else {
			return abort(503);
		}
	}

	public function searchs(Request $request) {
		$input = $request->all();
		$categories = Category::tree();
		
		if(!empty($input['tag']) && strlen($input['tag']) > 1){
			//$cus_tag = Unicode::make($input['tag']);
			$ex_tag = explode(' ', $input['tag'] );
			$full_tag = '';
			
			if(strlen($ex_tag[0]) > 3){
				foreach ($ex_tag as $value) {
					$full_tag .= " +".$value;
				}
			}else{
				$tag = [
					strtolower($ex_tag[0]),
					strtoupper($ex_tag[0]),
					ucfirst($ex_tag[0]),
					ucwords($ex_tag[0])
				];
				$product = Product::select('name_product', 'preview')->where('name_product', 'LIKE', '%'.$ex_tag[0].'%')->orWhere('preview', 'LIKE', '%'.$ex_tag[0].'%');
				foreach ($tag as $v) {
					$product->orWhere('name_product', 'LIKE', '%'.$v.'%')->orWhere('preview', 'LIKE', '%'.$v.'%');
				}
				$products = $product->get();

				foreach ($products as $val) {
					//echo 1;
					if (!preg_match('/[\'"()]/', $val->preview ) AND !preg_match('/[\'"()]/', $val->name_product )){
						// $ex_tag2 = explode(' ', $val->name_product);
						// foreach ($ex_tag2 as $v){
							$full_tag .= " +".$val->name_product;
						// }
					}
				}
				
			}
			//dd($full_tag);
			//dd($full_tag);die();
			if($input['cat'] == 0) {
				$searchs = [];
				$data = Product::where(function($q) use ($full_tag) {
					$q->orWhereRaw("MATCH(name_product) AGAINST('".$full_tag."')")->orWhereRaw("MATCH(preview) AGAINST('".$full_tag."')");
				})->where('status', 1)->paginate(2);
				//$data = DB::select('SELECT * FROM `products` WHERE MATCH(name_product) AGAINST(" +Áo đẹp") OR ');
				//dd($data);
			}else{
				$catChild = $this->getChild($input['cat']);
				
				$parent_id = $this->getParent($input['cat']);
				//$searchs = Search::where('category_id', $parent_id)->first();
				$data = Product::where(function($q) use ($full_tag) {
					$q->orWhereRaw("MATCH(name_product) AGAINST('".$full_tag."')")->orWhereRaw("MATCH(preview) AGAINST('".$full_tag."')");
				})->where(function($query) use ($catChild, $input) {
					if(count($catChild) > 1){
						$query->orWhere('category_id', $input['cat']);
						foreach ($catChild as $value) {
							$query->orWhere('category_id', $value);
						}
					}else{
						$query->orWhere('category_id', $input['cat']);
					}
				})->where('status', 1)->where('value' ,'>', 0)->paginate(2);
			}
			if($request->ajax()){
				return response()->json(view()->make('public.modules.searchs.ajax.paginate', ['data' => $data])->with('input', $input)	->render());
			}else{
				return view()->make('public.modules.searchs.index',['data' => $data, 'categories' => $categories])->with('input', $input);
			}
		}else{
			$data = null;
			$searchs = [];
			return view()->make('public.modules.searchs.index',['data' => $data,'searchs' => $searchs, 'categories' => $categories])->with('input', $input);
		}
		
	}

	public function getParent($id) {
		$category = Category::find($id);
		$parent_id = $category->parent_id;
		if($parent_id == 0 ) {
			$category_id = $category->id;
		}else{
			$category_id = $this->getParent($parent_id);
		}
		return $category_id;
	}

	public function getChild($id) {
		
		$categories = Category::where('parent_id', $id)->get();
		if($categories->count()){
			foreach ($categories as $value) {
				$this->child[] = $value->id;
				$this->getChild($value->id);
			}
		}
		return $this->child;

	}

}
