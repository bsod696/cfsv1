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
		'menuid',
		'menuname',
		'menudate', 
		'menuqty', 
		'redeemstatus', 
		'redeemtimestamp', 
		'menuprice', 
		'txid',
		'staffid',
		];
}
