<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected $user_route  = 'user.login';
    protected $admin_route = 'admin.login';
    protected $shop_route = 'shop.login';
    protected $deliver_route = 'deliver.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (!$request->expectsJson()) {
            if (Route::is('user.*')) {
                return route($this->user_route);
            } elseif (Route::is('admin.*')) {
                return route($this->admin_route);
            } elseif (Route::is('shop.*')) {
                return route($this->shop_route);
            } elseif (Route::is('deliver.*')) {
                return route($this->deliver_route);
            } 
        }
    }
}
