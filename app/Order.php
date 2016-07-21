<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['customer_id', 'user_id', 'note', 'phuong_thuc', 'status'];

    protected $timestamp = true;

    public function products() {
    	return $this->belongsToMany('App\Product', 'order_products')->withPivot('colors')->withPivot('sizes')->withPivot('value')->withTimestamps();
    }

    public function users() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function customers() {
    	return $this->belongsTo('App\Customer', 'customer_id');
    }
}
