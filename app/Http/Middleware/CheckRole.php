<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $rol)
    {
        $user = Auth::user();
        if ($user->rol != $rol) {
            return to_route('no.permisos');
        }

        return $next($request);
    }
}