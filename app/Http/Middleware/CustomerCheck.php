<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(auth()->user()->roles->first()->name != 'Customer', 404);
        return $next($request);
    }
}
