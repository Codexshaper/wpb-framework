<?php
/**
 * This is the api routes file.
 *
 * You can declare your all api routes here.
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
	function( Request $request ) {
		echo 'API Test';
		die();
	}
);
