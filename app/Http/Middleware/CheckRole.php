<?php

namespace Calendario\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!$request->user()->hasAnyRole($roles)) {
            abort(401, 'Esta acción no esta autorizada.');
        }

        return $next($request);
    }
}
