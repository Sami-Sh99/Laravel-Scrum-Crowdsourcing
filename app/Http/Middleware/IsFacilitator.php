<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsFacilitator
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
            if(auth()->user()->is_verified)
                return $next($request);
            else
            return redirect('403')->withMessage('Rejected due to verifiaction restriction<... please contact admin to verify your account');
        }
        return redirect()->intended('/login');
 
    }
}
