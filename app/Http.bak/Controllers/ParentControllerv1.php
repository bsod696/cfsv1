<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class ParentControllerv1 extends Controller
{
	use AuthenticatesUsers;
    public function __construct(){$this->middleware('auth');}
    public function index(){return view('user.home');}

}
