<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = 'children';
	protected $fillable = [
		'fullname',
		'studentid', 
		'primary_parentid', 
		'secondary_parentid', 
		'class', 
		'school_session',
		'age',
		'gender',
		'height',
		'weight',
		'bmi',
		'target_calories',
		];
}
