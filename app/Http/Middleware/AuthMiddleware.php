<?php

namespace WPB\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  $guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {   
        foreach($guards as $guard) {
            if($guard == 'api') {
                 // throw new \Exception("Please install API", 1);
            }
        }

        if(\is_user_logged_in()) {
            return $next($request);
        }
        
        header('Location: '.\get_site_url().'/wp-admin');
        die();
    }
}
