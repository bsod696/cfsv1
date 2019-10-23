<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class StaffLoginController extends Controller
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
