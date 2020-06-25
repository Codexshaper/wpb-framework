<?php

use WPB\Support\Facades\Route;

/**
 * You can use either $router object or Route facate to create new route
 */

$router->get('test', function(){
	echo "API Test";
	die();
});