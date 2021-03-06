<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['address_name', 'phone_number', 'email', 'name'];

    protected $timestamp = true;

    public function orders() {
    	return $this->hasOne('App\Order', 'customer_id');
    }
}
