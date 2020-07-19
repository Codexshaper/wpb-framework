<?php
/**
 * This is the api routes file.
 *
 * You can declare your all api routes here.
 * Either $router object or Route facade
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

use Illuminate\Http\Request;
use WPB\Support\Facades\Route;

$router->get(
    'test',
    function (Request $request) {
        echo 'API Test';
        die();
    }
);
