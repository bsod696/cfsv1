<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
	protected $fillable = [
		'name',
		'desc',
		'type', 
		'allergy_id', 
		'stock', 
		'price', 
		'calories',
		'staffuid',
		];
}
