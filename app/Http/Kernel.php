<?php
/**
 * The file handle the request.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

namespace WPB\App\Http;

use WPB\Http\Kernel as HttpKernel;

/**
 * The request handler.
 *
 * @since      1.0.0
 *
 * @author     Md Abu Ahsan basir <maab.career@gmail.com>
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middleware_groups = [
        'web' => [
            \WPB\App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $route_middleware = [
        'auth'  => \WPB\App\Http\Middleware\AuthMiddleware::class,
        'scope' => \WPB\App\Http\Middleware\Scope::class,
    ];
}
