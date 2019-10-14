<?php

namespace App\Http\Middleware;

use Closure;
use App\Merchant;
use Illuminate\Support\Facades\Auth;

class CheckRoleMerchant
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

        if ($user = Merchant::where('email', $userAuth->email)->exists()) {
            return $next($request);
        }else {
            abort(403);
        }
    }
}
