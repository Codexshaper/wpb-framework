<?php

use WPB\Support\Facades\Route;

/**
 * You can use either $router object or Route facate to create new route
 */

$router->get('test', function(){
    echo wpb_view('welcome');
    die();
});


Route::get('route/facade', function(){
    echo "This is a facade route";
    die();
});