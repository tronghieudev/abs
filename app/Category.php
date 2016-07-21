<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Parameter;

class Category extends Model {

	protected $table = 'categories';

	protected $fillable = ['name_category', 'meta_seo', 'parent_id'];

	protected $timestamp = true;

	public function parent() {

        return $this->hasOne($this, 'id', 'parent_id');

    }

    public function children() {

        return $this->hasMany($this, 'parent_id', 'id');

    }  

    public static function tree() {

        return static::with(implode('.', array_fill(0, 3, 'children')))->where('parent_id', '=', 0)->get();

    }

    public function parameters() {
        return $this->hasMany('App\Parameter', 'category_id');
    }

    public function sizes() {
        return $this->hasMany('App\Size', 'category_id');
    }

    public function products() {
        return $this->hasMany('App\Product', 'category_id');
    }

    public function searchs(){
        return $this->hasMany('App\Search', 'category_id');
    }

    public static $rules = [
        'name_category' => 'required',
    ];

}