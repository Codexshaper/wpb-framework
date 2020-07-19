<?php
/**
 * This file verify nonce.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * The verify csrf token class for wp nonce.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class VerifyCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request The app http request.
     * @param \Closure                 $next    The next closure.
     *
     * @throws \Exception Throw the exception.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->input('_token') ?? $request->header('X-CSRF-TOKEN');
        $action = $request->wpb_nonce ?? 'wpb_nonce';

        if (!wp_verify_nonce($token, $action)) {
            if ($request->ajax()) {
                return wp_send_json(['message' => 'CSRF Token mitchmatch'], 403);
            }

            throw new \Exception('CSRF Token mismatch');
        }

        return $next($request);
    }
}
