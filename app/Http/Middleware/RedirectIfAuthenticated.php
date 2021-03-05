<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && $guard === 'user') {
            return redirect(RouteServiceProvider::HOME);
        } elseif (Auth::guard($guard)->check() && $guard === 'admin') {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        } elseif (Auth::guard($guard)->check() && $guard === 'shop') {
            return redirect(RouteServiceProvider::SHOP_HOME);
        } elseif (Auth::guard($guard)->check() && $guard === 'deliver') {
            return redirect(RouteServiceProvider::DELIVER_HOME);
        } 

        return $next($request);
    }
}
