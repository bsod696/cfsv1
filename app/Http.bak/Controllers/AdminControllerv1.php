<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class AdminControllerv1 extends Controller
{
    use AuthenticatesUsers;
    public function __construct(){$this->middleware('auth:admin');}
    public function index(){return view('admin.dashboard');}
}
