<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->isTeacher()) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
