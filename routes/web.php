<?php
/**
 * This is the web routes file.
 *
 * You can declare your all web routes here.
 * Either $router object or Route facade
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 */

use Illuminate\Http\Request;
use WPB\Support\Facades\Route;

$router->get(
    'test',
    function () {
        echo wpb_view('welcome');
        die();
    }
);

Route::get(
    'test/facade',
    function (Request $request) {
        echo 'This is a facade route';
        die();
    }
);
