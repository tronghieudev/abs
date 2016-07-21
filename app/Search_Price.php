<?php

namespace App;

use App\Search;
use Illuminate\Database\Eloquent\Model;

class Search_Price extends Model{

	protected $table = 'price_searchs';

	protected $fillable = ['price_from', 'price_to'];

	protected $timestamp = true;

	public function searechs(){
		return $this->belongsTo('App\Search', 'search_id');
	}

}