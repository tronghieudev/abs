<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\ProductUpdate;
use App\Color;
use App\Size;
use App\Parameter;
use App\Helpers\MenuSelect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller {

	public function getIndex() {

		$data = Product::has('categories')->where('status', 1)->get();
		
		return view('admin.modules.products.index', ['data' => $data]);

	}

	public function getFormAdd() {
		$color = Color::lists('color', 'id');
		$color[0] = '-- Không có màu --';
		$cat = Category::tree()->where('parent_id', '>=', 0);
		$category = new MenuSelect;
		$categories = $category->getMenu($cat, 'category_id', null, ['class' => 'form-control', 'id' => 'category_id']);
		return view('admin.modules.products.add', ['color' => $color, 'categories' => $categories]);
	}

	public function postFormAdd() {
		$input = Input::all();
		$valid = Validator::make($input, Product::$rules);
		if($valid->passes()) {
			try{
				// Xử lý hình ảnh
				for ($i=0; $i < count(Input::file('images')) ; $i++) { 
					$arrName[$i] = time() .'-'. Input::file('images')[$i]->getClientOriginalName();
					Image::make(Input::file('images')[$i])->resize(600, 750)->save('public/multimedia/images/products/'.$arrName[$i]);
				}

				$input['images'] = json_encode($arrName);
				$product = new Product;
				$product->fill($input);
				$product->save();

				// Xử lý thông số
				if(!empty($input['parameter'])){
					foreach ($input['parameter'] as $key => $value) {
						$product->parameters()->attach($key, ['value' => $value]);
					}
				}
				// Xử lý màu
				if(!empty($input['color'])){
					foreach ($input['color'] as $value) {
						if(!empty($value)){
							$colorCheck = Color::where('id', $value)->orWhere('color', $value);
							if($colorCheck->count() == 0) {
								$color = new Color;
								$color->color = $value;
								$color->save();
							}else{
								$color = $colorCheck->first();
							}
							$product->colors()->attach($color->id);
						}
					}
				}

				// Xử lý lưu size
				if(!empty($input['size'])){
					foreach ($input['size'] as $value) {
						$product->sizes()->attach($value);
					}
				}
				// Lưu là thống kê

				$update = new ProductUpdate;
				$update->product_id = $product->id;
				$update->value = $input['value'];
				$update->save();
				//$update->user_id = $user_id;
				return redirect()->route('admin.products.getIndex')->with('messages', 'Thêm sản phẩm thành công');
			} catch (Exception $e) {
				return redirect()->back()->with('messages', 'Cố lỗi');
			}
		} else {
			return redirect()->back()->with('messages', 'Vui lòng nhập thông tin đầy đủ');
		}
	}

	public function getFormEdit($id) {
		$data['product'] = Product::with('categories', 'colors', 'sizes', 'parameters')->find($id);
		
		//get parent_id();
		$parent_id = $this->getParent($data['product']->categories->id);
		$parametersData = [];
		foreach ($data['product']->parameters as $value) {
			$parametersData[$value->id] = $value->pivot->value;
		}
		$cat = Category::tree()->where('parent_id', '>=', 0);
		$category = new MenuSelect;
		$data['categories'] = $category->getMenu($cat, 'category_id', $data['product']->category_id, ['class' => 'form-control', 'id' => 'category_id']);
		$data['colors'] = Color::lists('color', 'id');
		$data['colors'][0] = '-- Không có màu --';
		$data['sizes'] = Size::where('category_id', $parent_id)->lists('size', 'id');
		$data['sizes'][0] = '-- Không có kích thước --';
		$data['parameters'] = Parameter::where('category_id', $parent_id)->get();

		return view('admin.modules.products.edit', $data)->with('parametersData', $parametersData);
	}

	public function postFormEdit($id) {
		$input = Input::all();
		$rules = Product::$rules;
		//$speakers = $input['parameter'];
		
		//dd($input['size']);
		//	;die();
		unset($rules['images']);
		$valid = Validator::make($input, $rules);
		if($valid->passes()) {
			try{
				$product = Product::find($id);
				$so_luong = $product->value;
				// Xử lý hình ảnh
				if(!empty(Input::file('images')[0])){
					for ($i=0; $i < count(Input::file('images')) ; $i++) { 
						$arrName[$i] = time() .'-'. Input::file('images')[$i]->getClientOriginalName();
						Image::make(Input::file('images')[$i])->resize(600, 750)->save('public/multimedia/images/products/'.$arrName[$i]);
					}
					
					//$input['images'] = json_encode($arrName);
					
					$image = json_decode($product->images, true);
					$input['images'] = json_encode(array_merge($image, $arrName));
				}else{
					unset($input['images']);
				}
				$product->fill($input);
				$product->save();

				// Xử lý thông số

				if(!empty($input['parameter'])){
					foreach ($input['parameter'] as $key => $value) {
						$parameters[$key]['value'] = $value;
					}

					$product->parameters()->sync($parameters);
				}
				// Xử lý màu
				if(!empty($input['color'])){
					foreach ($input['color'] as $key => $value) {
						if($value != 0){
							$colorCheck = Color::where('id', $value)->orWhere('color', $value);
							if($colorCheck->count() == 0) {
								$color = new Color;
								$color->color = $value;
								$color->save();
								$input['color'][$key] = $color->id;
							}
						}else{
							unset($input['color'][$key]);
						}
					}


					$product->colors()->sync($input['color']);
				}
				// Xử lý lưu size
				if(!empty($input['color'])){
					foreach ($input['size'] as $key => $value) {
						if($value == 0){
							unset($input['size'][$key]);
						}
					}

					//foreach ($input['size'] as $value) {
					$product->sizes()->sync($input['size']);
				}

				// Lưu là thống kê
				
				if($so_luong > $input['value'] || $so_luong < $input['value']){
					$update = new ProductUpdate;
					$update->product_id = $product->id;
					$update->value = $input['value'] - $so_luong;
					$update->save();
				}

				
				//$update->user_id = $user_id;
				return redirect()->route('admin.products.getIndex')->with('messages', 'Cập nhập sản phẩm thành công');
			} catch (Exception $e) {
				return redirect()->back()->with('messages', 'Cố lỗi');
			}
		} else {
			return redirect()->back()->with('messages', 'Vui lòng nhập thông tin đầy đủ');
		}
	}

	public function postDel(Request $request) {
		$input = Input::all();
		if($request->ajax()) {
			try{
				$product = Product::find($input['id']);
				
				$product->status = 0;
				$product->save();
				$response = ['description' => 'Xoá thành công', 'core' => 200];
				return response()->json($response);
			}catch(Exception $e) {
				$response = ['description' => 'Xoá không thành công', 'core' => 500];
				return response()->json($response);
			}
		}
	}

	// ajax

	public function postCategories() {
		$id = Input::get('category_id');	
		$parent_id = $this->getParent($id);

		$parameters = Parameter::where('category_id', $parent_id)->get();
		$sizes = Size::where('category_id', $parent_id)->lists('size', 'id');
		$sizes[0] = '-- Không có kích thước --';
		return view()->make('admin.modules.products.ajax.parameter', ['parameters' => $parameters, 'sizes' => $sizes]);
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

	//set Image

	public function getSetImage(Request $request) {
		if($request->ajax()) {
			$input = Input::all();
			$id = $input['id'];
			$key = $input['key'];
			$product = Product::find($id);
			if($product != null) {
				try{
					$image = json_decode($product->images, true);
					if(file_exists('public/multimedia/images/products/'.$image[$key])) {
						unlink('public/multimedia/images/products/'.$image[$key]);
					}
					unset($image[$key]);
					$sql_image = json_encode($image);
					$product->images = $sql_image;
					$result = $product->save();
					if($result == true) {
						$response = ['code' => 200, 'description' => 'Xoá thành công'];
						return \Response::json($response);
					}else {
						$response = ['description' => 'Xoá không thành công'];
						return \Response::json($response);
					}
				} catch (\Exception $e) {
					$response = ['description' => 'Có lỗi trong quá trình xoá'];
					return \Response::json($response);
				}
			} else {
				$response = ['description' => 'Hiện tại không có hình này'];
				return \Response::json($response);
			}
		}
	}

}