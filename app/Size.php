<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Size;
use App\Category;

class Size extends Model {

	protected $table = 'sizes';

	protected $fillable = ['size', 'category_id'];

	protected $timestamp = true;

	public static $rules = [
        'size' => 'required',
        'category_id' => 'required'
    ];

    public function categories() {
    	return $this->belongsTo('App\Category', 'category_id');
    }

    public function products() {
        return $this->belongsToMany('App\Product', 'product_sizes')->withTimestamps();
    }

    public function searchs() {
        return $this->belongsToMany('App\Search', 'search_colors')->withTimestamps();
    }


}