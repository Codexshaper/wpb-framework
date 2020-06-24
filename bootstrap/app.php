<?php
require_once(ABSPATH.'wp-includes/pluggable.php');
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__. '/../src/helpers.php';

use WPB\Application;

// global $app;
$app = (new Application([
	'paths' => [
		'root' => WPB_APP_ROOT
	]
]));

$container = $app->getInstance();

try {
	$router = $app->loadRoutes();
	$response = $router->dispatch(\Illuminate\Http\Request::capture());
	$response->send();

} catch(\Exception $ex) {
	if(! \WPB\Support\Facades\Route::current()) {
		return true;
	}
	throw new \Exception($ex, 1);
}
