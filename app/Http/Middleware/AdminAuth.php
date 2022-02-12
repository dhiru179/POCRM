<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        if($request->session()->has('ADMIN_LOGIN'))
        {
        //   $request->session()->put('ADMIN_LOGIN',true);//run continues
        //   print_r($request->session());
           
        }
        else
        {
          $request->session()->flash('error','Access Denied');
          return redirect('/');
        }
        return $next($request);
    }
}
