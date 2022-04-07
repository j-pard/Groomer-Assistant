<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;

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
        Carbon::setLocale(App::getLocale());

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
