<?php

define( 'APP_ROOT', __DIR__ );
define( 'WPB_FILE', __FILE__ );
define( 'WPB_PATH', dirname( WPB_FILE ) );
define( 'WPB_INCLUDES', WPB_PATH . '/includes' );
define( 'WPB_URL', plugins_url( '', WPB_FILE ) );
define( 'WPB_ASSETS', WPB_URL . '/public' );

require_once __DIR__.'/bootstrap/app.php';

use CodexShaper\OAuth2\Server\Http\Requests\ServerRequest;
use CodexShaper\OAuth2\Server\Manager;
use Codexshaper\App\Menus\Admin;
use Codexshaper\App\Menus\Menu;
use League\OAuth2\Server\Exception\OAuthServerException;

function checkApiAuth( $result ){
	// var_dump($result);
	// die();

    // $yourEncryptAPIKey = $_GET['request'];

    // if( yourDecryptFn( $yourEncryptAPIKey ) === $realKey ):
    //     $result = true;

    // else:
    //     $result = false;

    // endif;

    // return $result;

    return $result;           
}

add_filter('rest_authentication_errors', 'checkApiAuth');

function cs_bypass_user_for_oauth_authentication($user_id) {

	if ( (function_exists('is_oauth_enable') && is_oauth_enable() === false) || ($user_id && $user_id > 0 )) {
		return (int) $user_id;
	}

	$manager 		= new Manager;
	$resourceServer = $manager->getResourceServer();
	$request 		= ServerRequest::getPsrServerRequest();

	try {
	    $psr 		= $resourceServer->validateAuthenticatedRequest($request);
	    $user_id 	= $manager->validateUserForRequest($psr);
	    
	    if ($user_id) {
	    	return $user_id;
	    }

	} catch (OAuthServerException $e) {
		return null;
	}

	return null;
}

add_filter( 'determine_current_user', 'cs_bypass_user_for_oauth_authentication' );

// $menu = new Admin;

// $menu->page_title = "New Menu";
// $menu->menu_title = "New Menu";
// $menu->capability = "manage_options";
// $menu->slug = "wpb-test";
// $menu->callback = function() {
//         echo '<div class="wrap"><div id="wpb-admin" csrf-token="'.csrf_token().'"></div></div>';
// };
// $menu->icon = "dashicons-text";

// $menu->save();

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/maab16
 * @since             1.0.0
 * @package           Wp_Plugin_Builder
 *
 * @wordpress-plugin
 * Plugin Name:       Wp Plugin Builder Framework
 * Plugin URI:        https://github.com/Codexshaper/wp-plugin-builder
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Abu Ahsan basir
 * Author URI:        https://github.com/maab16
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-plugin-builder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_PLUGIN_BUILDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-plugin-builder-activator.php
 */
function activate_wp_plugin_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-builder-activator.php';
	Wp_Plugin_Builder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-plugin-builder-deactivator.php
 */
function deactivate_wp_plugin_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-builder-deactivator.php';
	Wp_Plugin_Builder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_plugin_builder' );
register_deactivation_hook( __FILE__, 'deactivate_wp_plugin_builder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-builder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_plugin_builder() {

	$plugin = new Wp_Plugin_Builder();
	$plugin->run();

}
run_wp_plugin_builder();
