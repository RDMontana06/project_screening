<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Approver
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
        if ((Auth::user()->roles == 1) || (Auth::user()->roles == 3)) {
            return $next($request);
        } else {
            abort(403, 'You Dont Have Access');
        }
    }
}
