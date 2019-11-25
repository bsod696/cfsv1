<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountDet extends Model
{
    protected $table = 'account_details';
	protected $fillable = [
		'staffid',
		'fullname',
		'billaddr1',
		'billaddr2',
		'city',
		'zipcode',
		'state',
		'country',
		'bankname',
		'banknum',
		'defaultpay',
		];
}
