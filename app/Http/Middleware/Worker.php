<?php

namespace App\Http\Middleware;

use Closure;

class Worker
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
        if(!$request->user()->hasRole('worker'))
        {
            return abort(404);
        }

        return $next($request);
    }
}
