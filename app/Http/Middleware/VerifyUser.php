<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('user_id')){
            $request->session()->put('user_role',UserRole::where('user_id',session('user_id'))->value('role_name'));
            return $next($request);
        }
        else{
            return redirect()->route('login.view');
        }
    }
}
