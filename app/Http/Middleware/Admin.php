<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // dd(auth()->user()->roles);
        if (Auth::user()->roles == 1) {
            return redirect()->route('projectScreening');
        } else if (Auth::user()->roles == 2) {
            return redirect()->route('projectScreening');
        } else {
            return redirect()->route('projectApproval');
        }
    }
}
