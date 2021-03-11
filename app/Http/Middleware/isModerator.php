<?php

namespace App\Http\Middleware;

use Closure;

class isModerator
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
        if($role === User::ROLE_ADMIN || $role === User::ROLE_ADMIN){
          return $next($request);
        }else {
          return response(['error' => 'Forbidden'], 403);
        }
    }
}
