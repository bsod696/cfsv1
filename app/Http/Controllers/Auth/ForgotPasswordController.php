<?php

namespace App\Http\Controllers\Auth;

// use Auth;
use Password;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the reset email form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(){
        return view('auth.passwords.parentemail',[
            'title' => 'Parent Password Reset',
            'passwordEmailRoute' => 'user.password.email'
        ]);
    }
    /**
     * password broker for staff guard.
     * 
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker(){
        return Password::broker();
    }
}
