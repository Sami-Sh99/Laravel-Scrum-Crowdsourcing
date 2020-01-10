<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isFacilitator
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
    
        if (auth()->user() && auth()->user()->role =='F') {
            return $next($request);
        }
            return response()->json('Not Allow');
 
    }
}
