<?php

namespace App\Http\Middleware;

use Closure;

class notAdmin
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
        if (auth()->user() && auth()->user()->role !='A') {
            return $next($request);
        }
        if (auth()->user() && auth()->user()->role =='A') {
            return redirect()->intended('admin');
        }
            return response()->json('protected route');
    }
}
