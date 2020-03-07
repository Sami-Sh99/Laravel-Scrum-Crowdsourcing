<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsParticipant
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
        if (auth()->user() && auth()->user()->role =='P') {
            return $next($request);
        }
        return redirect()->intended('/login');
 
    }
}
