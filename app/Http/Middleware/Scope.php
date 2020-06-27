<?php

namespace WPB\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CodexShaper\Database\Facades\Schema;
use CodexShaper\OAuth2\Server\Http\Requests\ServerRequest;
use CodexShaper\OAuth2\Server\Manager;
use League\OAuth2\Server\Exception\OAuthServerException;
use WPB\App\User;

class Scope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  $scopes
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        foreach ($scopes as $scope) {
            if (! in_array($scope, $request->scopes)) {
                wp_send_json( ["msg" => "You don't have enough permission"], 400 );
            }
        }  

        return $next($request);
    }
}
