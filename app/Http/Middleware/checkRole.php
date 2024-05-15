<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {

        $sessionKey = $role === 'admin' ? config('session.admin_session') : config('session.user_session');

        if (!$request->session()->has($sessionKey)) {
            return redirect('/login');
        }

        return $next($request);
    }
}
