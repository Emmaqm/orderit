<?php

namespace App\Http\Middleware;

use Closure;
use App\Employee;
use Illuminate\Support\Facades\Auth;

class CheckRoleEmployee
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

        $userAuth = Auth::user();

        if ($user = Employee::where('email', $userAuth->email)->exists()) {
            return $next($request);
        }else {
            abort(403);
        }
        
    }
}
