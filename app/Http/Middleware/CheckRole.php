<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

  /*    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            return redirect('home');
        }else {
            //return $next($request);
            abort(403, "No tienes autorización para ingresar.");
        }
    }*/
    public function handle($request, Closure $next,$role )
    {
        if (! $request->user()->hasRole($role) && $role->name == "user") {
            return redirect('home');
        }else {
            //return $next($request);
            abort(403, "No tienes autorización para ingresar.");
        }
    }
}
