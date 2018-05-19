<?php

namespace App\Http\Middleware;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserMiddleware
{

    public function getAuthUser() {
        return response()->json(Auth::user());
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            

/*
    Teste le rôle du user connecté
        Retourne 0 si c'est un élève
        Retourne 1 si c'est un admin
*/
        if(getAuthUser()->role_id == 1)
            return $next($request);
        return response('You are not allowed to do that.', 401);
        
        
    }
}
