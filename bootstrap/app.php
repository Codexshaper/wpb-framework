<?php
/**
 * The file that defines the bootsrap plugin
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/bootstrap
 */

require_once ABSPATH . 'wp-includes/pluggable.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

use WPB\Application;

$app = ( new Application(
	array(
		'paths' => array(
			'root' => WPB_APP_ROOT,
		),
	)
) );

$container = $app->getInstance();

$container->singleton(
	Illuminate\Contracts\Http\Kernel::class,
	\WPB\App\Http\Kernel::class
);
$container->singleton(
	\Illuminate\Contracts\Debug\ExceptionHandler::class,
	\WPB\App\Exceptions\Handler::class
);

try {

	$kernel = $container->make( \Illuminate\Contracts\Http\Kernel::class );

	$response = $kernel->handle( \Illuminate\Http\Request::capture() );

	$response->send();

} catch ( \Exception $ex ) {
	if ( ! \WPB\Support\Facades\Route::current() ) {
		return true;
	}
	throw new \Exception( $ex, 1 );
}
