<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parameter;
use App\Category;

class Parameter extends Model {

	protected $table = 'parameters';

	protected $fillable = ['name_parameter', 'category_id'];

	protected $timestamp = true;

	public static $rules = [
        'name_parameter' => 'required',
        'category_id' => 'required'
    ];

    public function categories() {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function products() {
        return $this->belongsToMany('App\Product', 'product_parameters')->withPivot('value')->withTimestamps();
    }

}