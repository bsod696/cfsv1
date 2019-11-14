<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
	protected $fillable = [
		'fullname',
		'studentid', 
		'primary_parentid', 
		'secondary_parentid', 
		'class', 
		'school_session',
		'dob',
		'age',
		'gender',
		'height',
		'weight',
		'bmi',
		'target_calories',
		'allergies',
		];
}
