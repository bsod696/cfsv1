<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
	protected $fillable = [
		'parentid',
		'studentid',
		'studentname',
		'menu_id',
		'menu_name',
		'menu_date', 
		'menu_qty', 
		'redeem_status', 
		'redeem_timestamp', 
		'menu_price', 
		'txid',
		];
}
