<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
	protected $fillable = [
		'menu_id',
		'parentuid',
		'order_id', 
		'tx_status', 
		'tx_reference', 
		'tx_amount',
		'txid', 
		];
}
