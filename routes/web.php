<?php
/**
 * This is the web routes file.
 *
 * You can declare your all web routes here.
 * Either $router object or Route facade
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 * @subpackage WPB/routes
 */

use WPB\Support\Facades\Route;
use Illuminate\Http\Request;

$router->get(
	'test',
	function() {
		echo wpb_view( 'welcome' );
		die();
	}
);

Route::get(
	'test/facade',
	function( Request $request ) {
		echo 'This is a facade route';
		die();
	}
);
