<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Color;

class Color extends Model {

	protected $table = 'colors';

	protected $fillable = ['color'];

	protected $timestamp = true;

	public static $rules = [
        'color' => 'required',
    ];

    public function products() {
		return $this->belongsToMany('App\Product', 'product_colors')->withTimestamps();
	}

	public function searchs() {
		return $this->belongsToMany('App\Search', 'search_colors')->withTimestamps();
	}

}