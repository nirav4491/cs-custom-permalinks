<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nirav4491
 * @since             1.0.0
 * @package           Customise_Permalinks
 *
 * @wordpress-plugin
 * Plugin Name:       Customise Permalinks
 * Plugin URI:        https://github.com/nirav4491
 * Description:       This plugin helps customise the permalinks for all post types, default/custom.
 * Version:           1.0.0
 * Author:            Nirav Mehta
 * Author URI:        https://github.com/nirav4491
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       customise-permalinks
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
define( 'CSTMLINKS_PLUGIN_VERSION', '1.0.0' );

// Set the plugin URL.
if ( ! defined( 'CSTMLINKS_PLUGIN_URL' ) ) {
	define( 'CSTMLINKS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
// Set the plugin path.
if ( ! defined( 'CSTMLINKS_PLUGIN_PATH' ) ) {
	define( 'CSTMLINKS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-customise-permalinks-activator.php
 */
function cstmlinks_register_activation_hook_callback() {
	require_once 'includes/class-customise-permalinks-activator.php';
	Customise_Permalinks_Activator::activate();
}

register_activation_hook( __FILE__, 'cstmlinks_register_activation_hook_callback' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-customise-permalinks-deactivator.php
 */
function cstmlinks_register_deactivation_hook_callback() {
	require_once 'includes/class-customise-permalinks-deactivator.php';
	Customise_Permalinks_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'cstmlinks_register_deactivation_hook_callback' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function cstmlinks_run_cs_custom_permalinks() {
	// The core plugin class that is used to define internationalization, admin-specific hooks, and public-facing site hooks.
	require 'includes/class-customise-permalinks.php';
	$plugin = new Customise_Permalinks();
	$plugin->run();
}

/**
 * Check plugin requirement on plugins loaded.
 */
function cstmlinks_plugins_loaded_callback() {
	cstmlinks_run_cs_custom_permalinks();
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'cstmlinks_plugin_action_links_callback' );
	// sample comment.
}

add_action( 'plugins_loaded', 'cstmlinks_plugins_loaded_callback' );

/**
 * Custom plugin links.
 *
 * @param array $links Holds the array of plugin links.
 * @return array
 */
function cstmlinks_plugin_action_links_callback( $links = array() ) {
	$this_plugin_links = array(
		'<a href="' . admin_url( '/options-general.php?page=customise-permalinks' ) . '">' . __( 'Settings', 'customise-permalinks' ) . '</a>',
	);

	return array_merge( $this_plugin_links, $links );
}
