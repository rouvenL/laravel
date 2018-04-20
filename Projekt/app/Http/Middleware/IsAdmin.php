<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
        if(Auth::check() && Auth::user()->isAdmin())
        {
                return $next($request); //If user is Admin he can view /admin, if not he gets returned to /home
        }
        return redirect('home'); 
    }
    
    
}
