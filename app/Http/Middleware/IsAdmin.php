<?php

namespace App\Http\Middleware;
namespace App\User;

use Closure;

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
        $role = auth()->user()->role;

        if ( $role !== User::ROLE_ADMIN)
            return response(['error' = 'Forbidden'] , 403);
        
        return $next($request);
    }
}
