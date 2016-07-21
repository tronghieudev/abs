<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Parameter;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;

class ParameterController extends Controller {

	public function getIndex() {
		$category = Category::where('parent_id', 0)->lists('name_category', 'id');
		$data = Parameter::all();
		return view()->make('admin.modules.parameters.index', ['data' => $data, 'category' => $category]);
	}

	public function getForm(Request $request) {
		if($request->ajax()) {
			$id = Input::get('id');
			if(!empty($id)) {
				$data = Parameter::find($id);
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
		$valid = Validator::make($input, Parameter::$rules);
		if($valid->passes()){
			if(!isset($input['id'])) {
				try{
					$parameter = new Parameter;
					$parameter->fill($input);
					$parameter->save();
					return redirect()->route('admin.parameters.getIndex')->with('messages', 'Thêm danh mục thành công');
				} catch (Exception $e) {
					return redirect()->back()->with('messages', 'Có lỗi trong quá trình thêm thông số');
				}
			}else{
				try{
					$parameter = Parameter::find($input['id']);
					$parameter->fill($input);
					$parameter->save();
					return redirect()->route('admin.parameters.getIndex')->with('messages', 'Chỉnh sửa danh mục thành công');
				} catch (Exception $e) {
					return redirect()->route('admin.parameters.getIndex')->with('messages', 'Có lỗi trong quá trình sửa danh mục');
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
				$data = Parameter::find($id);
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