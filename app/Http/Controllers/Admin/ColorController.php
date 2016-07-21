<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Color;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;

class ColorController extends Controller {

	public function getIndex() {
		$data = Color::all();
		return view()->make('admin.modules.colors.index', ['data' => $data]);
	}

	public function getForm(Request $request) {
		if($request->ajax()) {
			$id = Input::get('id');
			if(!empty($id)) {
				$data = Color::find($id);
				
				$response = ['description' => 'Chỉnh sửa màu', 'data' => $data];
				return response()->json($response);
			} else {
				$response = ['description' => 'Thêm danh màu mới'];
				return response()->json($response);
			}
		}
	}

	public function postForm() {
		$input = Input::all();
		$valid = Validator::make($input, Color::$rules);
		if($valid->passes()){
			if(!isset($input['id'])) {
				try{
					$color = new Color;
					$color->fill($input);
					$color->save();
					return redirect()->route('admin.colors.getIndex')->with('messages', 'Thêm màu thành công');
				} catch (Exception $e) {
					return redirect()->back()->with('messages', 'Có lỗi trong quá trình thêm màu');
				}
			}else{
				try{
					$color = Color::find($input['id']);
					$color->fill($input);
					$color->save();
					return redirect()->route('admin.colors.getIndex')->with('messages', 'Chỉnh sửa màu thành công');
				} catch (Exception $e) {
					return redirect()->back()->with('messages', 'Có lỗi trong quá trình sửa màu');
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
				$data = Color::find($id);
				$data->delete();
				$response = ['description' => 'Xoá màu thành công'];
				return response()->json($response);
			} catch(Exception $e ) {
				$response = ['description' => 'Xoá không thành công'];
				return response()->json($response);
			}
		}
	}

}