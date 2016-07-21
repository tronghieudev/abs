<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {

	protected $table = 'searchs';

	protected $fillable = ['name_search', 'category_id'];

	protected $timestamp = true;

	public function categories(){
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function price_searchs(){
		return $this->hasMany('App\Search_Price', 'search_id');
	}

	public function sizes() {
		return $this->belongsToMany('App\Size', 'search_sizes')->withTimestamps();
	}

	public function colors() {
		return $this->belongsToMany('App\Color', 'search_colors')->withTimestamps();
	}

}