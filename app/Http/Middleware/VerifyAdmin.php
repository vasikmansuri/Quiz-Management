<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;

class VerifyAdmin
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

            $role=UserRole::where('user_id',session('user_id'))->first();
            if($role->role_name=='admin'){
                return $next($request);
            }
            else{
                return redirect()->back();
            }
    }
}
