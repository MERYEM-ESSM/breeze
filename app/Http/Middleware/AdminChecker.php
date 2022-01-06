<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check($request)){
            return redirect()->route('login');
        }
        if(Auth::user()->role_id===1){
            return $next($request);
        }
       if(Auth::user()->role_id===2){
            return redirect()->route('user.home');
        }
   
        
        // elseif(Auth::user()->role_id===2){
        //    c
        // };
   
      
    }
}
