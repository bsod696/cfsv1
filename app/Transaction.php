<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
	protected $fillable = [
		'parentid',
		'paymentid',
		'orderid', 
		'txstatus', 
		'txreference', 
		'txamount',
		'txid', 
		];
}
