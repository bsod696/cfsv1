<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $table = 'allergy';
	protected $fillable = [
		'allergies',
		'childuid',
		];
}
