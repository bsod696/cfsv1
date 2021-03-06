<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class StaffResetPasswordController extends Controller
{
    /**
     * This will do all the heavy lifting
     * for resetting the password.
     */
    use ResetsPasswords;
     /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/staff/dashboard';
    /**
     * Only guests for "staff" guard are allowed except
     * for logout.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff');
    }
    /**
     * Show the reset password form.
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null){
        return view('auth.passwords.staffreset',[
            'title' => 'Reset Staff Password',
            'passwordUpdateRoute' => 'staff.password.update',
            'token' => $token,
        ]);
    }
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(){
        return Password::broker('staffs');
    }
    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard(){
        return Auth::guard('staff');
    }
}