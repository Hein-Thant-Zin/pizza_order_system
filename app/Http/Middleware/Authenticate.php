<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Routing\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('auth#loginPage');
        }
    }
}

//create AdminAuthMiddleware
// if (Auth::user()->role == 'admin') {
//     abort(404);
// }
//create UserAuthMiddleware
// if (Auth::user()->role == 'user') {
//     abort(404);
// }

//to create in Kernel
//'admin_auth' => Middleware::class;
//'user_auth' => Middleware::class;
