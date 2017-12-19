<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (! auth()->check()) { //Si el usuario no ha iniciado sesion se reenvia al login
            return redirect('login'); 
        }

        if (auth()->user()->role !=0) // No es ADMIN
        {
            return redirect('home');
        }


        //La solcitud se pasa a lo que continua y sigue su recorrido normal
        return $next($request);
    }
}
