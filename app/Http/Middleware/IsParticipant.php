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
            if(auth()->user()->is_verified)
                return $next($request);
            else
                return redirect('403')->withMessage('Rejected due to verifiaction restriction<... please contact admin to verify your account');
        }
            return redirect('403')->withMessage('Unauthorized action');
 
    }
}
