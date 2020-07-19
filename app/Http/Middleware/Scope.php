<?php
/**
 * This file handle scope middleware.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * The scope middleware class.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Scope
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request   The app http request.
     * @param \Closure                 $next      The next closure.
     * @param array                    ...$scopes The requested guards.
     *
     * @throws \Exception Throw the exception.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        foreach ($scopes as $scope) {
            if (!in_array($scope, $request->scopes)) {
                wp_send_json(['msg' => "You don't have enough permission"], 400);
            }
        }

        return $next($request);
    }
}
