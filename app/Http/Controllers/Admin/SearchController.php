<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Search;
use App\Search_Price;
use App\Category;
use App\Color;
use App\Size;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;

class SearchController extends Controller {

	public function getIndex() {
		$data = Search::all();
		return view()->make('admin.modules.searchs.index', ['data' => $data]);

	}

	public function getForm($id) {
		$color = Color::lists('color', 'id');
		$size = Size::lists('size', 'id');
		$categories = Category::where('parent_id', 0)->lists('name_category', 'id');
		if($id == 0){
			return view()->make('admin.modules.searchs.getForm', ['sizes' => $size, 'colors' => $color, 'categories' => $categories]);
		}
	}

	public function postForm() {

		$input = Input::all();
		try{
			$search = new Search;
			$search->fill($input);
			$search->save();
			foreach ($input['price'] as $value) {
				$price = new Search_Price;
				$price->price_from = $value[0];
				$price->price_to = $value[1];
				$price->search_id = $search->id;
				$price->save();
			}
			if(empty($input['color'])){
				$input['color'] =  [];
			}
			if(empty($input['size'])){
				$input['size'] =  [];
			}
			foreach ($input['color'] as $value) {
				$search->colors()->attach($value);
			}
			foreach ($input['size'] as $value) {
				$search->sizes()->attach($value);
			}
			return redirect()->route('admin.searchs.getIndex')->with('messages', 'Thêm thành công');
		}catch(Exception $e) {
			return redirect()->back()->with('messages', 'Có lỗi');
		}
		//dd($input);
	}

	public function getEdit($id) {
		$search = Search::find($id);
		//dd($search->sizes);die();
		if(!empty($search)){
			$color = Color::lists('color', 'id');
			$size = Size::lists('size', 'id');
			$categories = Category::where('parent_id', 0)->lists('name_category', 'id');
			return view()->make('admin.modules.searchs.edit', ['search' => $search, 'colors' => $color, 'sizes' => $size, 'categories' => $categories]);
		}else{
			
		}
	}

	public function postEdit($id) {
		$input = Input::all();
		try{
			$search = Search::find($id);
			$search->fill($input);
			$search->save();
			$price = Search_Price::where('search_id', $id)->delete();
			foreach ($input['price'] as $value) {
				$price = new Search_Price;
				$price->price_from = $value[0];
				$price->price_to = $value[1];
				$price->search_id = $id;
				$price->save();
			}
			if(empty($input['color'])){
				$input['color'] =  [];
			}
			if(empty($input['size'])){
				$input['size'] =  [];
			}
			$search->colors()->sync($input['color']);
			$search->sizes()->sync($input['size']);
			return redirect()->route('admin.searchs.getIndex')->with('messages', 'Chỉnh sửa thành công');
		}catch(Exception $e) {
			return redirect()->back()->with('messages', 'Chỉnh sửa không thành công');
		}
	}

	public function postDel(Request $request) {
		if($request->ajax()) {
			$input = Input::all();
			try{
				$search = Search::find($input['id']);
				$price = Search_Price::where('search_id', $input['id'])->delete();
				$search->colors()->detach();
				$search->sizes()->detach();
				$search->delete();
				$response = ['description' => 'Xoá thành công'];
				return response()->json($response);
			}catch(Exception $e) {
				$response = ['description' => 'Xoá không thành công'];
				return response()->json($response);
			}
		}
	}

}