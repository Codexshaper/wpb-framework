<?php
/**
 * This file handle scope middleware.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/app/Http/Middleware
 */

namespace WPB\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CodexShaper\Database\Facades\Schema;
use CodexShaper\OAuth2\Server\Http\Requests\ServerRequest;
use CodexShaper\OAuth2\Server\Manager;
use League\OAuth2\Server\Exception\OAuthServerException;
use WPB\App\User;

/**
 * The scope middleware class.
 *
 * @since      1.0.0
 * @package    WPB
 * @subpackage WPB/app/Http/Middleware
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Scope {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request The app http request.
	 * @param  \Closure                 $next The next closure.
	 * @param   array                    ...$scopes The requested guards.
	 *
	 * @throws \Exception Throw the exception.
	 *
	 * @return mixed
	 */
	public function handle( Request $request, Closure $next, ...$scopes ) {
		foreach ( $scopes as $scope ) {
			if ( ! in_array( $scope, $request->scopes ) ) {
				wp_send_json( array( 'msg' => "You don't have enough permission" ), 400 );
			}
		}

		return $next( $request );
	}
}
