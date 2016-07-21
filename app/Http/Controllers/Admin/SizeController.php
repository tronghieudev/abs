<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;

class SizeController extends Controller {

	public function getIndex() {
		$category = Category::where('parent_id', 0)->lists('name_category', 'id');
		$data = Size::all();
		return view()->make('admin.modules.sizes.index', ['data' => $data, 'category' => $category]);
	}

	public function getForm(Request $request) {
		if($request->ajax()) {
			$id = Input::get('id');
			if(!empty($id)) {
				$data = Size::find($id);
				$cate = $data->categories->id;
				$response = ['description' => 'Chỉnh sửa danh mục', 'data' => $data, 'cate' => $cate];
				return response()->json($response);
			} else {
				$response = ['description' => 'Thêm danh mục mới'];
				return response()->json($response);
			}
		}
	}

	public function postForm() {
		$input = Input::all();
		$valid = Validator::make($input, Size::$rules);
		if($valid->passes()){
			if(!isset($input['id'])) {
				try{
					$size = new Size;
					$size->fill($input);
					$size->save();
					return redirect()->route('admin.sizes.getIndex')->with('messages', 'Thêm danh mục thành công');
				} catch (Exception $e) {
					return redirect()->back()->with('messages', 'Có lỗi trong quá trình thêm danh mục');
				}
			}else{
				try{
					$size = Size::find($input['id']);
					$size->fill($input);
					$size->save();
					return redirect()->route('admin.sizes.getIndex')->with('messages', 'Chỉnh sửa danh mục thành công');
				} catch (Exception $e) {
					return redirect()->route('admin.sizes.getIndex')->with('messages', 'Có lỗi trong quá trình sửa danh mục');
				}
			}
		} else {
			return redirect()->back()->withInput()->with('messages', 'Vui lòng nhập thông tin đầy đủ');
		}
	}	

	public function getDel(Request $request) {
		if($request->ajax()) {
			try{
				$id = Input::get('id');
				$data = Size::find($id);
				$data->delete();
				$response = ['description' => 'Xoá danh mục thành công'];
				return response()->json($response);
			} catch(Exception $e ) {
				$response = ['description' => 'Xoá không thành công'];
				return response()->json($response);
			}
		}
	}

}