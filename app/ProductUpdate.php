<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductUpdate;

class ProductUpdate extends Model {

	protected $table = 'product_updateds';

	protected $fillable = ['product_id', 'value', 'user_id'];

	protected $timestamp = true;

	public function products() {
		return $this->belongsTo('App\Product', 'product_id');
	}

}