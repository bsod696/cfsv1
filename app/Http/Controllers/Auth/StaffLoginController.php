<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class StaffLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(){return view('auth.stafflogin');}
    protected function guard(){return Auth::guard('staff');}
    
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/staff/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){$this->middleware('guest:staff')->except('logout');}
    public function logout() {
        Auth::guard('staff')->logout();
        return redirect('/staff/login');
    }
}
