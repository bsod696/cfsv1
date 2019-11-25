<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
	protected $fillable = [
		'menuname',
		'menudesc',
		'menutype', 
		'allergyid', 
		'stock', 
		'menuprice', 
		'menucalories',
		'menupic',
		'staffid',
		];
}
