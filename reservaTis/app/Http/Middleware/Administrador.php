<?php

namespace Reserva\Http\Middleware;
/*permite acceder ala cesion*/
use Illuminate\Contracts\Auth\Guard;
use Session;
use Closure;
use Reserva\User;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     /*protected $auth;*/

     /*public function __constructor(Guard $auth)
     {
       $this->auth = $auth;
     }*/

    public function handle($request, Closure $next)
    {
        $rol = 'Administrador';
        $userRol = $request->user()->hasRole($rol);
        //dd($userRol);
        if ($userRol == true) {
            //return redirect('/home');
            return $next($request);
        }else {
              return redirect('/home');
              }
    }
}
