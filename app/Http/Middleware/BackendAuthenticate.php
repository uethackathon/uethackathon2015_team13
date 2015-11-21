<?php

namespace App\Http\Middleware;

use Closure;

class BackendAuthenticate
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
        /**
         * TODO: Since there are no role/permission/policy systems implemented, I'm here for nothing ._.
         */
        return $next($request);
    }
}
