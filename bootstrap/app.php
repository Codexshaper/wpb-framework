<?php
require_once(ABSPATH.'wp-includes/pluggable.php');
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__. '/../vendor/illuminate/support/helpers.php';
require_once __DIR__. '/../vendor/codexshaper/wpb-foundation/src/helpers.php';

use CodexShaper\WP\Application;

$app = $container = (new Application([
	'paths' => [
		'root' => WPB_APP_ROOT
	]
]))->getInstance();

global $app;

$container->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    CodexShaper\App\Http\Kernel::class
);
$container->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \CodexShaper\App\Exceptions\Handler::class
);

if(\CodexShaper\WP\Support\Facades\Route::exists(\Illuminate\Http\Request::capture())) {
	try {

		$kernel = $container->make(Illuminate\Contracts\Http\Kernel::class);

		$response = $kernel->handle(
		    $request = Illuminate\Http\Request::capture()
		);

		$response->send();

	} catch(\Exception $ex) {
		if(! \CodexShaper\WP\Support\Facades\Route::current()) {
			return true;
		}
		throw new \Exception($ex, 1);
	}
}

