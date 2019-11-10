<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if(Route::is('admin.*')){
            return route('admin.login');
        }
        if(Route::is('staff.*')){
            return route('staff.login');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
