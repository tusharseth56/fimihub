<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminAuth
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
        if(!$request->session()->exists('admin_data')){
            // user value cannot be found in session
            Session::flash('message', 'Please Login!'); 
            return redirect('/adminQbeez/login');
        }
        elseif(session('admin_data')->user_type !=1){
            Session::flash('message', 'User Type Invalid !'); 
            return redirect('/adminQbeez/login');
        }

        return $next($request);
    }
}
