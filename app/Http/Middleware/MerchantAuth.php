<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class MerchantAuth
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
        if(!$request->session()->exists('user')){
            if(session('user')->user_type !=2){
                Session::flash('message', 'User Type Invalid !'); 
                return redirect('/merchant/login');
            }
            // user value cannot be found in session
            Session::flash('message', 'Please Login!'); 
            return redirect('/merchant/login');
        }
        elseif(session('user')->user_type !=2){
            Session::flash('message', 'User Type Invalid !'); 
            return redirect('/merchant/login');
        }

        return $next($request);
    }
}
