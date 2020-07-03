<?php
/**
 * The all functions.
 *
 * @link       https://github.com/maab16
 * @since      1.0.0
 *
 * @package    WPB
 */

use WPB\Application;
use Illuminate\Container\Container;

if ( ! function_exists( 'wpb_csrf_token' ) ) {
	/**
	 * Generate wp nonce.
	 *
	 * @param string|null $action   This is the nonce action name.
	 *
	 * @return null|string
	 */
	function wpb_csrf_token( $action = 'wpb_nonce' ) {
		return wp_create_nonce( $action );
	}
}

if ( ! function_exists( 'wpb_app' ) ) {
	/**
	 * Get the available container instance.
	 *
	 * @param string|null $abstract The abstruct.
	 * @param array       $parameters The parameters.
	 *
	 * @return mixed|\Illuminate\Contracts\Foundation\Application
	 */
	function wpb_app( $abstract = null, array $parameters = array() ) {
		$app = new Application();
		if ( is_null( $abstract ) && $container != null ) {
			return $container;
		}

		return Container::getInstance()->make( $abstract, $parameters );
	}
}

if ( ! function_exists( 'wpb_config' ) ) {
	/**
	 * Get / set the specified configuration value.
	 *
	 * If an array is passed as the key, we will assume you want to set an array of values.
	 *
	 * @param array|string|null $key This is the key for config array.
	 * @param mixed             $default This is the default config value.
	 *
	 * @return mixed|\Illuminate\Config\Repository
	 */
	function wpb_config( $key = null, $default = null ) {
		if ( is_null( $key ) ) {
			return app( 'config' );
		}

		if ( is_array( $key ) ) {
			return app( 'config' )->set( $key );
		}

		return app( 'config' )->get( $key, $default );
	}
}

if ( ! function_exists( 'wpb_view' ) ) {
	/**
	 * Render blade view.
	 *
	 * @param string $view   This is the filename.
	 * @param array  $data   This is the view data.
	 * @param array  $merge_data   This is the merge data for view.
	 *
	 * @throws \Exception This will throw an exception if view class doesn't exists.
	 * @return null|string
	 */
	function wpb_view( $view, $data = array(), $merge_data = array() ) {
		if ( ! class_exists( \CodexShaper\Blade\View::class ) ) {
			throw new \Exception( 'View not resolved. Please install View' );
		}

		return ( new \CodexShaper\Blade\View( array( __DIR__ . '/../resources/views' ), __DIR__ . '/../storage/cache' ) )->make( $view, $data = array(), $merge_data = array() );
	}
}
