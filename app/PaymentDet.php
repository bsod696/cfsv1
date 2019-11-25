<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDet extends Model
{
    protected $table = 'payment_details';
	protected $fillable = [
		'parentid',
		'fullname',
		'billaddr1',
		'billaddr2',
		'city',
		'zipcode',
		'state',
		'country',
		'cardtype',
		'cardnum',
		'cvvnum',
		'expdate',
		'defaultpay',
		];
}
