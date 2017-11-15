<?php

namespace Reserva\Http\Middleware;

use Closure;

class Secretaria
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
      $rol = 'Administrador';
       $userRol = $request->user()->hasRole($rol);
       if ($userRol == true) {
            //return redirect('/home');
              return $next($request);
       }else {
               $rol = 'Docente';
               $userRol = $request->user()->hasRole($rol);
               if ($userRol == true) {
                    return $next($request);
               }else {
                       $rol = 'Secretaria';
                       $userRol = $request->user()->hasRole($rol);
                       if ($userRol == true) {
                            return $next($request);
                       }else {
                               return redirect('/home');
                             }
                     }
             }
        
    }
}
