<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsGuest
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
        if(Auth::check()) //check if user is logged on
        {
            return $next($request); //user is logged on
        }
        return redirect('/'); //not logged on
        
    }
}
