<?php

use WPB\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * You can use either $router object or Route facate to create new route
 */

$router->get('test', function(Request $request){
	echo "API Test";
	die();
});