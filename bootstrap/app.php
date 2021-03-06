<?php
/**
 * The file that defines the bootsrap plugin.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */
require_once ABSPATH.'wp-includes/pluggable.php';
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/helpers.php';

use WPB\Application;

$app = ( new Application(
    [
        'paths' => [
            'root' => WPB_APP_ROOT,
        ],
    ]
) );

global $wpb_app;

$wpb_app = $container = $app->get_instance();

$container->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    \WPB\App\Http\Kernel::class
);
$container->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \WPB\App\Exceptions\Handler::class
);

if (\WPB\Support\Facades\Route::exists(\Illuminate\Http\Request::capture())) {
    try {
        $kernel = $container->make(\Illuminate\Contracts\Http\Kernel::class);

        $response = $kernel->handle(\Illuminate\Http\Request::capture());

        $response->send();
    } catch (\Exception $ex) {
        if (!\WPB\Support\Facades\Route::current()) {
            return true;
        }

        throw new \Exception($ex, 1);
    }
}
