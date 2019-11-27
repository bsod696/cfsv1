<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Years extends Model
{
    protected $table = 'years';
	protected $fillable = [
		'yearsnum',
		'years',
		];
}
