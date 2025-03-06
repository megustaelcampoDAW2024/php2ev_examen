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

        //Si user->access es == 0 se redirige a la ruta permiso
        if($user->access == 0){
            return to_route('no.permisos');
        }

        return $next($request);
    }
}