<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function showLoginForm(){return view('auth.adminlogin');}
    protected function guard(){return Auth::guard('admin');}

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){$this->middleware('guest:admin')->except('logout');}
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}