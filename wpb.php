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
 * @package           wpb_framework
 *
 * @wordpress-plugin
 * Plugin Name:       Wp Plugin Builder Framework
 * Plugin URI:        https://github.com/Codexshaper/wpb-framework
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

define( 'APP_ROOT', __DIR__ );
define( 'WPB_FILE', __FILE__ );
define( 'WPB_PATH', dirname( WPB_FILE ) );
define( 'WPB_INCLUDES', WPB_PATH . '/includes' );
define( 'WPB_URL', plugins_url( '', WPB_FILE ) );
define( 'WPB_ASSETS', WPB_URL . '/public' );

require_once __DIR__.'/bootstrap/app.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPB_FRAMEWORK_VERSION', '1.0.0' );

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

	$plugin = new WPB_Framework();
	$plugin->run();

}
run_wp_plugin_builder();
