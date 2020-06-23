<?php

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
 * @package           WPB
 *
 * @wordpress-plugin
 * Plugin Name:       WPB
 * Plugin URI:        https://github.com/Codexshaper/wpb-framework
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Abu Ahsan basir
 * Author URI:        https://github.com/maab16
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpb
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Application root directory.
if (!defined('WPB_APP_ROOT')) {
	define( 'WPB_APP_ROOT', __DIR__ );
}
// Worpress plugin builder file path.
if (!defined('WPB_FILE')) {
	define( 'WPB_FILE', __FILE__ );
}
// Worpress plugin builder directory path.
if (!defined('WPB_PATH')) {
	define( 'WPB_PATH', dirname( WPB_FILE ) );
}
// Worpress plugin builder includes path.
if (!defined('WPB_INCLUDES')) {
	define( 'WPB_INCLUDES', WPB_PATH . '/includes' );
}
// Worpress plugin builder url.
if (!defined('WPB_URL')) {
	define( 'WPB_URL', plugins_url( '', WPB_FILE ) );
}
// Worpress plugin builder assets path.
if (!defined('WPB_ASSETS')) {
	define( 'WPB_ASSETS', WPB_URL . '/public' );
}

require_once __DIR__.'/bootstrap/app.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPB_FRAMEWORK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpb-framework-activator.php
 */
function activate_wpb_framework() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpb-framework-activator.php';
	WPB_Framework_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpb-framework-deactivator.php
 */
function deactivate_wpb_framework() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpb-framework-deactivator.php';
	WPB_Framework_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpb_framework' );
register_deactivation_hook( __FILE__, 'deactivate_wpb_framework' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpb-framework.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpb_framework() {

	$plugin = new WPB_Framework();
	$plugin->run();

}
run_wpb_framework();
