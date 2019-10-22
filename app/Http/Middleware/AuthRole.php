<?php

namespace App\Http\Middleware;

use Closure;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, String $role)
    {
        if(!$request->user() || !$request->user()->hasRole($role)) {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
