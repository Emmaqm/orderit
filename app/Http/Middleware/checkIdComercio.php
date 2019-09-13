<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkIdComercio
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

        $user = Auth::user();

        if ($user->id_comercio == null) {

            return redirect()->route('establishment.create');

        }else if($user->id_comercio !== null){
           
            if($user->estado == false){
                return redirect()->route('establishment.pending')->with('MessageNeedActivation', 'Yes');
            }else {
                return $next($request);
            }
            
        }

        return $next($request);
    }
}
